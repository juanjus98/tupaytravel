<?php header('Content-type: text/html; charset=iso-8859-1'); ?>
<?php include("../../config/config.php"); ?>
<script type="text/javascript">
    tiny('descripcion');
    $(document).ready(function() {
        //$('#titulo').focus();
        return false;
    });
</script>
<script>
    function clearImg() {
        $('#logo').val("");
        $('#ShowImageUpdate').hide();
    }

    function showImage(nomImage) {
        //alert('Im�gen subida correctamente');
        $('#logo').val(nomImage);
        $('#ShowImageUpdate').show();
        $('#ShowImageUpdate').html('<img src="<?php echo URL_ADMIN; ?>timthumb.php?src=<?php echo URL_IMAS; ?>' + nomImage + '&amp;h=80&amp;&amp;zc=1&amp;q=90" height="80" /><br><a href="javascript:;" onclick="clearImg()"><b>X</b> Delete</a>');

        $('#flashImage').html('<object width="330" height="21"><param name="movie" value="empresa/swf/uploadImg.swf?cat="><embed src="empresa/swf/uploadImg.swf?cat=" width="330" height="21"></embed></object>');

    }

    function clearThumb() {
        $('#thumb').val("");
        $('#ShowThumbUpdate').hide();
    }

    function showThumb(nomImage) {
        //alert('Im�gen subida correctamente');
        $('#thumb').val(nomImage);
        $('#ShowThumbUpdate').show();
        $('#ShowThumbUpdate').html('<img src="<?php echo URL_ADMIN; ?>timthumb.php?src=<?php echo URL_IMAS; ?>' + nomImage + '&amp;h=80&amp;&amp;zc=1&amp;q=90" height="80" /><br><a href="javascript:;" onclick="clearThumb()"><b>X</b> Quitar</a>');

        $('#flashThumb').html('<object width="330" height="21"><param name="movie" value="products/swf/uploadThumb.swf?cat="><embed src="products/swf/uploadThumb.swf?cat=" width="330" height="21"></embed></object>');

    }

</script>
<form id="add_form" method="post" class="spform" accept-charset="utf-8">
    <fieldset>
        <legend>Agregar</legend>
        <table class="noborde">
            <tr>
                <td class=" a-right">Categor&iacute;a:</td>
                <td class="a-left" width="100">
                    <label>
                        <select name="id_categoria" id="id_categoria">
                            <option value="0">Seleccionar</option>
                            <?php echo sel_allcategory(); ?>
                        </select>
                    </label>    </td>
                <td class="a-right">Subcategor&iacute;a :</td>
                <td class="a-left"><label>
                        <select name="id_subcategoria" id="id_subcategoria">
                            <option value="0">Seleccionar</option>
                            <?php //echo sel_allcategory();?>
                        </select>
                    </label></td>
            </tr>
            <tr>
                <td class=" a-right">Nombre de Empresa:</td>
                <td class="a-left"><label>
                        <input name="nombre_empresa" type="text" class="sptext" id="nombre_empresa" value="" size="30" maxlength="32" />
                    </label></td>
                <td class="a-right">Direcci&oacute;n:</td>
                <td class="a-left"><label>
                        <input name="direccion" type="text" class="sptext" id="direccion" value="" />
                    </label></td>
            </tr>
            <tr>
                <td class=" a-right">Tel&eacute;fono:</td>
                <td class="a-left"><label>
                        <input name="telefono" type="text"  class="sptext" id="telefono"  />
                    </label>
                </td>
                <td class="a-right">E-mail:</td>
                <td class="a-left"><label>
                        <input name="email" type="text" class="sptext" id="email"  />
                    </label>
                </td>
            </tr>

            <tr>
                <td class=" a-right">Video (url youtube):</td>
                <td class="a-left"><label>
                        <input name="url_video" type="text"  class="sptext" id="url_video"  />
                    </label></td>
                <td class="a-right">Website:</td>
                <td class="a-left"><label>
                        <input name="website" type="text" class="sptext" id="website"  />
                    </label>
                </td>
            </tr>
            <tr>
                <td class=" a-right">Cont&aacute;cto:</td>
                <td class="a-left"><label>
                        <input name="contacto" type="text"  class="sptext" id="contacto" size="30"  />
                    </label>
                </td>

                <td class="a-right">Precio desde:</td>
                <td class="a-left"><label>
                        <input name="desde" type="text" class="sptext" id="desde"  />
                    </label>
                </td>
            </tr>

            <tr>
                <td class=" a-right">Verificar:</td>
                <td class="a-left">
                    <label>
                        <input type="checkbox" name="verificado" value="1" /> <b>Empresa verificada.</b>
                    </label>
                </td>

                <td class="a-right"></td>
                <td class="a-left"></td>

            </tr>

            <tr>
                <td class=" a-right">Descripci&oacute;n:</td>
                <td colspan="3" class="a-left"><label>
                        <textarea name="descripcion" rows="5" id="descripcion"></textarea>
                    </label></td>
            </tr>
            <tr>
                <td class="a-right" valign="top">Im&aacute;gen :</td>
                <td colspan="3">
                    <input type="hidden" name="logo" id="logo" />
                    <div id="flashImage">
                        <object width="330" height="21">
                            <param name="movie" value="empresa/swf/uploadImg.swf?cat=">
                            <embed src="empresa/swf/uploadImg.swf?cat=" width="330" height="21"></embed>
                        </object>
                    </div>
                    <!--input type="hidden" id="gimage" name="gimage" /-->
                    <span id="ShowImageUpdate"></span>      </td>
            </tr>

            <tr>
                <td class=" a-right">Kerwords:</td>
                <td colspan="3" class="a-left">
                    <label>
                        <textarea name="kerwords" rows="3" id="kerwords" placeholder="Palabras separadas por comas."></textarea>
                    </label>
                </td>
            </tr>

            <tr>
                <td class=" a-right">&nbsp;</td>
                <td class="a-left"><label>
                        <input type="submit" name="button" id="button" value="Guardar" class="uibutton confirm" />
                    </label></td>
                <td class="a-right">&nbsp;</td>
                <td class="a-left">&nbsp;</td>
            </tr>
        </table>
    </fieldset>

</form>
