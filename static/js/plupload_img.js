
//上传到本地
var uploader_img = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'selectImgFiles', 
	container: document.getElementById('container'),
	flash_swf_url : '/static/js/plupload/Moxie.swf',
	silverlight_xap_url : '/static/js/plupload/Moxie.xap',
    url : '/upload/local_upload',
    multi_selection : false,
    filters: {
        mime_types : [ //只允许上传图片和zip文件
        { title : "Image files", extensions : "jpg,gif,png,bmp,jpeg" }
      //  { title : "Zip files", extensions : "zip,rar" }
        ],
        max_file_size : '10mb', //最大只能上传10mb的文件
        prevent_duplicates : true //不允许选取重复文件
    },
	init: {
		PostInit: function() {
			document.getElementById('ossfile_img').innerHTML = '';
			document.getElementById('postImgfiles').onclick = function() {

            uploader_img.start();
            return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('ossfile_img').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b></div>';
			});
		},

        BeforeUpload: function(up, file) {

        },

		UploadProgress: function(up, file) {
			var d = document.getElementById(file.id);
			d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		FileUploaded: function(up, file, info) {
            console.log('uploaded')
            console.log(info);
            if (info.status >= 200 || info.status < 200) {
                if(info.response != ''){
                    var res_php = $.parseJSON(info.response);

                    if(res_php.status == 1){
                        $("#ossfile_img").prev().attr('src', res_php.data.file_name);
                        $("#img_url").val(res_php.data.file_name);
                        document.getElementById('ossfile_img').innerHTML = '';
                    }else{
                        alert(res_php.msg);
                    }
                }



            }
            else {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
            }
		},

		Error: function(up, err) {
            if (err.code == -600) {
                document.getElementById('ossfile_img').innerHTML = '选择的文件最大10MB，请重新选择';
                console.log('选择的文件太大了,可以根据应用情况，在upload.js 设置一下上传的最大大小');
            }
            else if (err.code == -601) {
                document.getElementById('ossfile_img').innerHTML = '不支持所选文件后缀名，请重新选择';
                console.log('选择的文件后缀不对,可以根据应用情况，在upload.js进行设置可允许的上传文件类型');
            }
            else if (err.code == -602) {
                console.log('这个文件已经上传过一遍了');
            }
            else {
                console.log('Error xml:' + err.response);
            }
		}
	}
});

uploader_img.init();
