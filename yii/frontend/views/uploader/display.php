<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<script type = "text/javascript" src = "/frontend/web/js/jquery.js"></script>
<script type = "text/javascript" src = "/frontend/web/js/dropzone.js"></script>
<link type = "text/css" rel = "stylesheet" href = "/frontend/web/css/dropzone.css">
<script type = "text/javascript">

          // Dropzone.autoDiscover = false;
           var myDropzone = new Dropzone("#my-dropzone", {
           url : "upload",
           method : "post",
           addRemoveLinks : true ,
           previewTemplate: $('#preview-template').html(),
           dictRemoveLinks: "x",
           dictCancelUpload: "x",
           dictCancelUploadConfirmation : '你确定取消上传吗?',
           dictFileTooBig: '该文件过大，上传失败，文件不能超过2.0M',
           dictMaxFilesExceeded: '图片数量已达上限，无法上传更多图片',

           dictDefaultMessage: '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i>请点此上传图片</span>\
                 <br /> \
                <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>',

           thumbnail: function(file, dataUrl) {
               if (file.previewElement) {
                   $(file.previewElement).removeClass("dz-file-preview");
                   var images = $(file.previewElement).find("[data-dz-thumbnail]").each(function() {
                       var thumbnailElement = this;
                       thumbnailElement.alt = file.name;
                       thumbnailElement.src = dataUrl;
                   });
                   setTimeout(function() {
                           $(file.previewElement).addClass("dz-image-preview");
                       },
                       1);
               }
           }
       });


      // 自定义的监听事件
      myDropzone.on("addedfile", function(file) {
          file.previewElement.addEventListener("click", function() {
              $(this).append('<a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove</a>');
              setDefaultImage($(this), file);
          });
      });
</script>
<form action = "upload" class = "dropzone"  id = "my-dropzone" enctype = "multipart/form-data">
    <div class = "fallback">
        <input type = "file" name = "file" multiple />
    </div>
</form>

<div id="preview-template" class="hide form-group">
    <div class="dz-preview dz-file-preview">
        <div class="dz-image">
            <img data-dz-thumbnail="" />
        </div>

        <div class="dz-details">
            <div class="dz-size">
                <span data-dz-size=""></span>
            </div>

            <div class="dz-filename">
                <span data-dz-name=""></span>
            </div>
        </div>

        <div class="dz-progress">
            <span class="dz-upload" data-dz-uploadprogress=""></span>
        </div>

        <div class="dz-error-message">
            <span data-dz-errormessage=""></span>
        </div>

        <div class="dz-success-mark">
							<span class="fa-stack fa-lg bigger-150">
    							<i class="fa fa-circle fa-stack-2x white"></i>
    							<i class="fa fa-check fa-stack-1x fa-inverse green"></i>
							</span>
        </div>

        <div class="dz-error-mark" style="top: 35%;left: 40%;">
							<span class="fa-stack fa-lg bigger-300">
    							<i class="fa fa-circle fa-stack-2x white"></i>
    							<i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
							</span>
        </div>
    </div>
</div>

