<?php

class ServerController extends CController
{
    public function actions()
    {
        return array(
            'insert'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }

    /**
     * @param string the $path of the Server
     * @return string the Server InsertDocumen
     * @soap
     */
    //public function getInsertDocument($path,$fecha,$rama,$codSiniestro)
    public function getInsertDocument($path)
    {
        /*
        //Insertamos en BD
        $siniestro = new Siniestros;
        $siniestro->codRama=$rama;
        $siniestro->codSiniestro=$codSiniestro;
        $siniestro->save();
        $documento = new Documentos;
        $documento->idsiniestros=$siniestro->primaryKey;
        $documento->Path=$path;
        $documento->save();
         *
         */
         //test 2
        return("punto 1");
    }
}

?>
