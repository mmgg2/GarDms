<?php
include 'protected/extensions/PHPMailer_5.2.1/class.phpmailer.php';
include 'protected/extensions/pclzip-2-8-2/pclzip.lib.php';
include 'protected/extensions/FPDI-1.4.2/concat_pdf.php';
include 'Logger/logger.php';

class DocumentosController extends Controller
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
                'actions'=>array('create','update','PrinterDoc','SendMail','DeleteDocumento','UpdateDocumentSelected','logViewImages','PrinterDocPlugin'),
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
        $model=new Documentos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Documentos']))
        {
            $model->attributes=$_POST['Documentos'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id_documentos));
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
            $id=$_GET['id'];
            if (isset($_GET['documentos_page'])){
                $documentos_page=$_GET['documentos_page'];
            }
            else{
                $documentos_page=1;
            }
            $model=$this->loadModel($id);
            $idSiniestro=$_GET['siniestro'];
            $desc_siniestro=$_GET['desc_siniestro'];

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            //test1

            if(isset($_POST['Documentos']))
            {
                $model->attributes=$_POST['Documentos'];
                if($model->save())
                $siniestroRelated = Siniestros::model()->findByPk($idSiniestro);
                $log = new myLogger("Logger/");
                $log->addLine("El documento $id relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue actualizado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                unset($log);
                //$this->redirect(array('view','id'=>$model->id_documentos));
                $check=array($model->id_documentos);
                $this->redirect(array('admin','idSiniestro'=>$idSiniestro,'desc'=>$desc_siniestro,'update'=>true,'Documentos_page'=>$documentos_page,'check'=>$check, 'msj'=>'El Documento con identificador  <b>'.$model->id_documentos.'</b> se actualizó correctamente'));
            }

            $this->render('update',array(
            'model'=>$model,
            'siniestro'=>$idSiniestro,
            'desc_siniestro'=>$desc_siniestro
            ));
    }


    public function actionUpdateDocumentSelected()
    {

		//documentos_page
		if (isset($_GET['documentos_page'])){
			$documentos_page=$_GET['documentos_page'];
		}
		else{
			$documentos_page=1;
		}

        if(isset($_POST['etiqueta']) or isset($_POST['descripcion']))
        {
            //Ver como actualizar los elementos seleccionados
            $check= explode(",",$_POST["docCheckUpdate"]);
            $log = new myLogger("Logger/");
            for($i=0;$i< count($check);$i++){
                $model = Documentos::model()->findByPk($check[$i]);
                $siniestroRelated = Siniestros::model()->findByPk($model->idsiniestros);
                $log->addLine("El documento $model->id_documentos relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue impreso por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                if(isset($_POST['etiqueta'])){
                    $model->etiqueta=$_POST['etiqueta'];
                }
                if(isset($_POST['descripcion'])){
                    $model->descripcion=$_POST['descripcion'];
                }
                $model->save();
            }
            unset($log);
            $this->redirect(array('admin','idSiniestro'=>$_GET['idSiniestro'],'Documentos_page'=>$documentos_page,'desc'=>$_GET['descSiniestro'],'update'=>true,'check'=>$check,'msj'=>'Los documentos se actualizaron correctamente'));
        }

        $this->render('formUpdate', array('siniestro'=>$_GET['idSiniestro'],'desc_siniestro'=>$_GET['descSiniestro'],'documentos_page'=>$documentos_page,'docCheck'=>$_GET['docCheck']));
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

    public function actionDeleteDocumento($id)
    {
        $idSiniestro=$_GET['siniestro'];
        $desc_siniestro=$_GET['desc_siniestro'];
        $model=$this->loadModel($id);
        $siniestroRelated = Siniestros::model()->findByPk($idSiniestro);
        $log = new myLogger("Logger/");
        if(Yii::app()->user->categoria=="admin"){
            $log->addLine("El documento $id relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue eliminado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            $model->delete();
            unset($log);
            $this->redirect(array('admin','idSiniestro'=>$idSiniestro,'desc'=>$desc_siniestro,'delete'=>true, 'msj'=>'El Documento con identificador  <b>'.$model->id_documentos.'</b> se eliminó correctamente'));
        }
        else if (Yii::app()->user->categoria=="digitalizador"){
            $modelModeratorDocument=new ModeratorDocumentos;
            $modelModeratorDocument->id_object=$model->id_documentos;
            $modelModeratorDocument->isSiniestro="Documento";
            $modelModeratorDocument->timestampCreacion=date("Y-m-d H:i:s");
            $modelModeratorDocument->username=Yii::app()->user->name;
            $modelModeratorDocument->codRama=$siniestroRelated->codRama;
            $modelModeratorDocument->codSiniestro=$siniestroRelated->codSiniestro;
            $model->flagDelete='false';
            $model->save();
            $log->addLine("El Documento: $id relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue solicitado para eliminarse por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            unset($log);
            if($modelModeratorDocument->save()){
                $this->redirect(array('admin','idSiniestro'=>$idSiniestro,'desc'=>$desc_siniestro,'delete'=>true, 'msj'=>'El Documento con identificador  <b>'.$model->id_documentos.'</b>  quedará pendiente de eliminación'));
            }
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Documentos');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $idSiniestro=$_GET['idSiniestro'];
        if (isset($_GET['Documentos_page'])){
               $documentos_page=$_GET['Documentos_page'];
         }
         else{
              $documentos_page=1;
         }
        if (isset($_GET['check'])){
             $check_doc=$_GET['check'];
         }
         else{
            $check_doc=array();
         }


        if (isset($_GET['desc'])){
             $descSiniestro=$_GET['desc'];
         }
         else{
             $descSiniestro="";
         }

        if (isset($_GET['msj'])){
             $msj=$_GET['msj'];
         }
         else{
             $msj="";
         }
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

         //Obtenemos las direcciones de mail
        $arrDestinarios=array();
        $file = fopen("protected/config/destinatarios_mail.txt", "r") or exit("Unable to open file!");
        //Output a line of the file until the end is reached
        while(!feof($file))
        {
            array_push($arrDestinarios,fgets($file));
        }
        fclose($file);

        $model=new Documentos('search');
		//$filtro=new Documentos;
		//$filtro->idsiniestros=$idSiniestro;
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Documentos']))
            $model->attributes=$_GET['Documentos'];
			$siniestroRelated = Siniestros::model()->findByPk($idSiniestro);
			$log = new myLogger("Logger/");
			$log->addLine("El Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fué visitado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
			unset($log);
			$this->render('admin',array(
			'model'=>$model,
			'desc'=>$descSiniestro,
			'siniestro'=>$idSiniestro,
			'msj'=>$msj,
			'update'=>$update,
			'arrDestinarios'=>$arrDestinarios,
			'documentos_page'=>$documentos_page,
			'delete'=>$delete,
			'check_doc'=>$check_doc,
			));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Documentos::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='documentos-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    public function actionPrinterDoc()
    {
            //get array
            $check=$_POST["check"];
            $pathDoc="";
            $pathAbsolute="/var/www/xxxx";
            $log = new myLogger("Logger/");
            for($i=0;$i< count($check);$i++){
                $doc = Documentos::model()->findByPk($check[$i]);
                $siniestroRelated = Siniestros::model()->findByPk($doc->idsiniestros);
                $log->addLine("El documento $doc->id_documentos relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue impreso por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
                if(!$doc->Path==""){
					//$pathDoc.= Yii::app()->request->getBaseUrl(true)."/".$doc->Path." ";
					$pathDoc.= $pathAbsolute."/".$doc->Path." ";
				}
				else{
					//$pathDoc.= Yii::app()->request->getBaseUrl(true)."/images/notdisponible.jpg"." ";
					$pathDoc.= $pathAbsolute."/images/notdisponible.jpg"." ";
				}
            }
			$log->addLine("Path of document:".$pathDoc);
            $img_path="/var/www/xxx/temporalDoc"; //ruta temporal para guardar el pdf
            $file_name=time();
            $dir="/usr/bin/convert";
            $log->addLine("Path of binary:".$dir);
            $comando="$dir $pathDoc $img_path/$file_name.pdf";
            $log->addLine("Command: ".$comando);
            exec($comando,$out);
            $response = array();
            $response['resp']=$comando;
            $response['filePrinter'] ="temporalDoc"."/$file_name.pdf";
            $log->addLine("Path for print: ".$response['filePrinter']);
            if(exec('echo EXEC',$out) == 'EXEC'){
				//echo 'exec works';
				$log->addLine("El comando exec esta instalado correctamente");
			}
			else{
				$log->addLine("Error:El comando exec no esta instalado correctamente");
			}
            unset($log);
            echo CJSON::encode($response);
    }

        public function actionPrinterDocPlugin()
    {

            $log = new myLogger("Logger/");
            $pathDoc= "/var/www/xxx/".$_POST["dataPath"]["link"]." ";
            $img_path="/var/www/xxx/temporalDoc"; //ruta temporal para guardar el pdf
            $file_name=time();
            $dir="/usr/bin/convert";
            $comando="$dir $pathDoc $img_path/$file_name.pdf";
            $log->addLine("(actionPrinterDocPlugin)Comando: ".$comando);
            exec($comando,$out);
            $response = array();
            $response['filePrinter'] ="temporalDoc"."/$file_name.pdf";
            unset($log);
            echo CJSON::encode($response);
    }


        public function actionSendMail()
    {
            try {
                //get array
                $check=$_POST["check"];
                $destinatarios=$_POST["arrDestinatarios"];
                $destSplit=explode(";",$destinatarios);
                $response = array();
                $log = new myLogger("Logger/");
                if(count($check) > 0){
                    $config = Config::model()->findByPk(1);
                    $zip = new PclZip('images/documentos.zip');
                    $allFile="";
                    for($i=0; $i<count($check); $i++) {
                        $model=Documentos::model()->findByPk($check[$i]);
                        $log->addLine("El usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')envió por mail el siguiente documento: '.$model->Path);
                        $allFile.=$model->Path.",";
                    }

                    unset($log);
                    $zip->create($allFile);
                    for ($i=0;$i<count($destSplit) - 1;$i++) {
                        $destinario=explode(",",$destSplit[$i]);
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = $config->correo_SMTPSecure;
                        $mail->Host = $config->correo_host;
                        $mail->Port = $config->correo_port;
                        $mail->Username = $config->correo_username;
                        $mail->Password = $config->correo_password;
                        //$mail->SMTPDebug = 2;
                        $mail->CharSet = "UTF-8";
                        $mail->From = $config->correo_from;
                        $mail->FromName = "Seguro Metal";
                        $mail->Subject = "Documentación-Seguro Metal";
                        $mail->AddAddress($destinario[1],$destinario[0]);
                        $mail->IsHTML(true);
                        $body1="";
                        $body1.= "<u><h5>Usted a recibido este mail con información adjunta</strong></h5></u><br>";
                        $body1.="********************************************************"."<br><br>";
                        $mail->Body = $body1;
                        $mail->AddAttachment("images/documentos.zip");
                        if(!$mail->Send()) {
                            $response['status'] ="error";
                            $response['description'] =$mail->ErrorInfo;
                        }
                        else{
                            $response['status'] ="ok";
                            $response['description'] ="Se ha enviado correctamente el mail";
                        }
                        unset($mail);
                    }
                }
            }
            catch (Exception $e) {
               $response['status'] ="error";
               $response['description'] =$e->getMessage();
            }
           echo CJSON::encode($response);
        }


        public function actionLogViewImages()
    {
            $idSiniestro=$_POST['idSinietro'];
            $id=$_POST['id'];
            $siniestroRelated = Siniestros::model()->findByPk($idSiniestro);
            $log = new myLogger("Logger/");
            $log->addLine("El documento $id relacionado al Siniestro con código de rama: $siniestroRelated->codRama y código de siniestro: $siniestroRelated->codSiniestro fue visualizado por el usuario:".Yii::app()->user->title."(".Yii::app()->user->name."-".Yii::app()->user->lastName.')');
            unset($log);
        }
}

?>
