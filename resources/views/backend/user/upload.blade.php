<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('backend/plugins/jQuery-File-Upload/jquery.fileupload.css')}}">
</head>
<body>
<input id="fileupload" type="file" name="files" multiple>
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/plugins/jQuery-File-Upload/jquery.fileupload.js')}}"></script>
<script>
    $(function () {
        $('#fileupload').fileupload({
            url:"{{route('user.avatar')}}",
            dataType: 'json',
            done: function (e, data) {
               console.log(data);
            }
        });
    });
</script>
</body>
</html>