function uploadFile(e, target_id) {
  if (e != null) {
    file = e.target.files[0];
    if (!file.name.match(/.(jpg|jpeg|png|gif|bmp|webp|svg)$/i)) {
      alert('The image you uploaded is not in the correct file format)');
      return;
    }
  }

  var url = '//' + window.location.host + '/api/upload';
  var xhr = new XMLHttpRequest();
  var fd = new FormData();
  xhr.open('POST', url, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  xhr.onreadystatechange = function(e) {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        // File uploaded successfully
        var obj = JSON.parse(xhr.responseText);
        if (obj.status == 0) {
          alert(obj.message); // Hiển thị thông báo lỗi từ phía server
          return;
        }

        document.getElementById(target_id).value = obj.url;
        $("#"+target_id).trigger('change');
      } else {
        alert('An error occurred during upload.');
      }
    }
  };
// Optional - add tag for image admin in Cloudinary
  fd.append('tags', 'browser_upload'); 
  if (e != null) {
    fd.append('file', file);
  }
  xhr.send(fd);
}
