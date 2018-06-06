<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">REGISTRO DE ASISTENCIAS</h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>ASISTENCIA</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <form class="form-horizontal" role="form" method="post" action="" autocomplete="on">
            <hr>
            <h4 class="panel-title"> <b>ALUMNOS</b></h4>
            <input type="hidden" name="formulario" id="formulario" value="{$formulario}">
            <div id="listar{$formulario}" >
                {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Código universitario</th>
                                <th>Nombres y Apellidos</th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">Marcar</th>
                                {/if}
                            </tr>
                            {$cont=0}
                            {foreach item=rl from=$listaDatos}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Dea_CodigoUniversitario}</td>
                                    <td>{$rl.Usu_Nombre} {$rl.Usu_Apellidos}</td> 
                                    
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">                                     
                                        
                                       <input type='checkbox' id='check{$cont}' name='check{$cont}' value='{$rl.Usr_IdUsuarioRol}' >
                                       <input type='hidden' id='id{$cont}' name='id{$cont}' value='{$rl.Usr_IdUsuarioRol}' >
                                    </td>
                                    {/if}
                                </tr>
                                {$cont=$cont+1}
                            {/foreach}
                        </table>
                    </div>
                {else}
                    {$lenguaje.no_registros}
                {/if}                
            </div>

            <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" type="submit" id="guardar" name="guardar" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

