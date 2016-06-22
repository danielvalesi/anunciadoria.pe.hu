    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->

<?php foreach($c->__extrafiles as $_f) require $_f; ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/icheck.js"></script>
<script type="text/javascript"  src="plugins/toggle-switch/toggles.min.js"></script> 
<script src="plugins/checkbox/zepto.js"></script>
<script src="plugins/checkbox/icheck.js"></script>
<script src="js/icheck-init.js"></script>
<script type="text/javascript" src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 
<script type="text/javascript" src="js/form-components.js"></script> 
<script type="text/javascript"  src="plugins/input-mask/jquery.inputmask.min.js"></script> 
<script type="text/javascript"  src="plugins/input-mask/demo-mask.js"></script> 
<script type="text/javascript"  src="plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script> 
<script type="text/javascript"  src="plugins/dropzone/dropzone.min.js"></script> 
<script type="text/javascript" src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/validation/parsley.min.js"></script>

<script src="plugins/file-uploader/js/vendor/jquery.ui.widget.js"></script> 
<script src="plugins/file-uploader/js/tmpl.min.js"></script> 
<script src="plugins/file-uploader/js/load-image.min.js"></script> 
<script src="plugins/file-uploader/js/canvas-to-blob.min.js"></script> 
<script src="plugins/file-uploader/js/jquery.blueimp-gallery.min.js"></script> 
<script src="plugins/file-uploader/js/jquery.iframe-transport.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-process.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-image.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-audio.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-video.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-validate.js"></script> 
<script src="plugins/file-uploader/js/jquery.fileupload-ui.js"></script> 
<!--<script src="plugins/file-uploader/js/main.js"></script>-->

<!-- The template to display files available for upload --> 
<script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload fade">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              <p class="name">{%=file.name%}</p>
              <strong class="error text-danger"></strong>
          </td>
          <td>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              {% if (!i && !o.options.autoUpload) { %}
              <button class="btn btn-primary start" disabled>
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Iniciar</span>
              </button>
              {% } %}
              {% if (!i) { %}
              <button class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancelar</span>
              </button>
              {% } %}
          </td>
      </tr>
      {% } %}
  </script> 
<!-- The template to display files available for download --> 
<script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-download fade">
          <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
          </td>
          <td>
              <p class="name">
                  {% if (file.url) { %}
                  <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                  {% } else { %}
                  <span>{%=file.name%}</span>
                  {% } %}
              </p>
              {% if (file.error) { %}
              <div><span class="label label-danger">Error</span> {%=file.error%}</div>
              {% } %}
          </td>
          <td>
              <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td>
              {% if (file.deleteUrl) { %}
              <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete</span>
              </button>
              <input type="checkbox" name="delete" value="1" class="toggle">
              {% } else { %}
              <button class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
              </button>
              {% } %}
          </td>
      </tr>
      {% } %}
  </script>

<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>

</body>
</html>