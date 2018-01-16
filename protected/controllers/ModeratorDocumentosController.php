<?php

include 'Logger/logger.php'; 

class ModeratorDocumentosController extends Controller
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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','deleteModeratorDocumentos','RollbackChange'),
                'users'=>array('*'),
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
        $model=new ModeratorDocumentos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ModeratorDocumentos']))
        {
            $model->attributes=$_POST['ModeratorDocumentos'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->idmoderatorDocumentos));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ModeratorDocumentos']))
        {
            $model->attributes=$_POST['ModeratorDocumentos'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->idmoderatorDocumentos));
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    
    public function actionDeleteModeratorDocumentos($id)
    {
        $model=$this->loadModel($id);
        $msj=NULL;
        $log = new myLogger("Logger/");
        if($model->isSiniestro=="Siniestro"){
            $siniestroRelated = Siniestros::model()->findByPk($model->id_object);
            $msj='El Siniestro con identificador  <b>'.$siniestroRelated->idsiniestros.'</b> y todos sus documentos relacionados se eliminaron correctamente.';
            $arrDocuments = Documentos::model()->findAll("idsiniestros=:id", array(':id' => $model->id_object));
            //delete documente of sinister
            foreach($arrDocuments as $indice => $valor) {
                $log->addLine("El Documento: $valor->id_documentos relacionado al Siniestro con código de rama:  $siniestroRelated->codRama y código de siniestro:  $siniestroRelated->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                $type="Documento";
                $arrModeratorDocument = ModeratorDocumentos::model()->findAll("id_object=:id and isSiniestro=:type", array(':id' => $valor->id_documentos,':type' => $type));
                foreach($arrModeratorDocument as $indice1 => $valor1) {
                    $valor1->delete(); 
                }
                $valor->delete(); 
            } 
            $log->addLine("El siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            $siniestroRelated->delete();
            unset($log);
        }else{
            $documentRelated = Documentos::model()->findByPk($model->id_object);
            $msj='El Documento con identificador  <b>'.$documentRelated->id_documentos.'</b> se eliminó correctamente.';
            $log->addLine("El documento $model->id_object relacionado al Siniestro con código de rama: $model->codRama y código de siniestro: $model->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            unset($log);
            $documentRelated->delete();
        }
        //delete sinister and document particularly in table ModeratorDocumentos
        $modelModeratorDocumentAll = ModeratorDocumentos::model()->findAll("id_object=:id and isSiniestro=:type", array(':id' => $model->id_object,':type' => $model->isSiniestro));
        foreach($modelModeratorDocumentAll as $indice2 => $valor2) {
            $valor2->delete(); 
        }
        $this->redirect(array('admin','delete'=>true,'msj'=>$msj)); 
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('ModeratorDocumentos');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new ModeratorDocumentos('search');
        $model->unsetAttributes();  // clear any default values
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
        if(isset($_GET['ModeratorDocumentos']))
            $model->attributes=$_GET['ModeratorDocumentos'];

        $this->render('admin',array(
            'model'=>$model,'delete'=>$delete,'msj'=>$msj
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=ModeratorDocumentos::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='moderator-documentos-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionRollbackChange(){
        $id_object=$_POST['id_object'];
        $type=$_POST['type'];
		$modelModeratorDocumentAll = ModeratorDocumentos::model()->findAll("id_object=:id and isSiniestro=:type", array(':id' => $id_object,':type' => $type));
        $isSiniestro="";
        foreach($modelModeratorDocumentAll as $indice2 => $valor2) {
           $isSiniestro=$valor2->isSiniestro;
        }
        $response = array();
        $log = new myLogger("Logger/");
        if($isSiniestro=="Siniestro"){
            $siniestro = Siniestros::model()->findByPk($id_object);
            $siniestro->flagDelete=''; 
            $log->addLine("La eliminación del siniestro con código de rama: $siniestro->codRama y código de siniestro: $siniestro->codSiniestro fue descartado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            $siniestro->save();
            unset($log);
            $arrDocuments = Documentos::model()->findAll("idsiniestros=:id", array(':id' => $id_object));
            $type="Documento";
            foreach($arrDocuments as $indice => $valor) {
                $arrModeratorDocument = ModeratorDocumentos::model()->findAll("id_object=:id and isSiniestro=:type", array(':id' => $valor->id_documentos,':type' => $type));
                foreach($arrModeratorDocument as $indice1 => $valor1) {
                    $valor1->delete(); 
                }
                $valor->flagDelete=''; 
                $valor->save();
            }  
        }else{
            $documentRelated = Documentos::model()->findByPk($id_object);
            $siniestroRelated = Siniestros::model()->findByPk($documentRelated->idsiniestros);
            $documentRelated->flagDelete='';
            $log->addLine("La eliminación del documento $id_object relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue descartado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            unset($log);
            $documentRelated->save();
        }
        
        foreach($modelModeratorDocumentAll as $indice2 => $valor2) {
            $valor2->delete(); 
        }
        $response['status'] ="ok";
        $response['description'] ="La solicitud de borrado fue descartada!!!";
        echo CJSON::encode($response);
    }
}
