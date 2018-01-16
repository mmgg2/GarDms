<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery');
           //Yii::app()->clientScript->registerCoreScript('jquery.ui');
           //$cs=Yii::app()->clientScript; $cs->registerCoreScript('jquery');
           //$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.prettyPhoto.js', CClientScript::POS_HEAD);

           //$cs->registerCssFile(Yii::app()->baseUrl . '/js/prettyPhoto.css');
           ?>

        <!-- Custom -->
        <script type="text/javascript" language="javascript" src="js/lightbox-print/js/lightbox.js"></script>
        <link href="js/lightbox-print/css/lightbox.css" rel="stylesheet" />


</head>

<script type="text/javascript">
//jQuery.noConflict();
</script>


<body>

<div class="container" id="page">

	<div id="header">
		<!--<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>-->
		<div id="logo">DMS Test</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
                    $arrayMenu=null;
                    if(Yii::app()->user->isGuest){
                        $arrayMenu=array(
                                'items'=>array(
                                        //array('label'=>'Home', 'url'=>array('/documentos/index')),
                                        //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                        //array('label'=>'Contact', 'url'=>array('/site/contact')),
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                ),
                        );
                    }
                    else{
                        if(Yii::app()->user->categoria=="admin"){
                            $arrayMenu=array(
                                    'items'=>array(
                                            array('label'=>'Gestión Documental', 'url'=>array('/siniestros/admin')),
                                            array('label'=>'Administración', 'url'=>array('/usuarios/admin')),
                                            //array('label'=>'Logger', 'url'=>array('/site/page', 'view'=>'about')),
                                            //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                            //array('label'=>'Contact', 'url'=>array('/site/contact')),
                                            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                    ),
                            );

                        }
                         else if(Yii::app()->user->categoria=="digitalizador"){
                            $arrayMenu=array(
                                    'items'=>array(
                                            array('label'=>'Gestión Documental', 'url'=>array('/siniestros/admin')),
                                            //array('label'=>'Administración', 'url'=>array('/usuarios/admin')),
                                            //array('label'=>'Logger', 'url'=>array('/site/page', 'view'=>'about')),
                                            //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                            //array('label'=>'Contact', 'url'=>array('/site/contact')),
                                            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                    ),
                            );

                        }
                        else{
							  $arrayMenu=array(
								'items'=>array(
										array('label'=>'Gestión Documental', 'url'=>array('/siniestros/admin')),
										array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
										array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
								),
							);
                        }
                    }


                    /*
                    $this->widget('zii.widgets.CMenu',array(
                            'items'=>array(
                                    array('label'=>'Home', 'url'=>array('/documentos/index')),
                                    //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                    //array('label'=>'Contact', 'url'=>array('/site/contact')),
                                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                            ),
                    )); */

                    $this->widget('zii.widgets.CMenu',$arrayMenu);
                ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?><br/>
		Todos los derechos reservados.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
