<!doctype html>
<html lang="en">
<head>
    <style>
        .wrapper{
            width:600px;
            border: 1px solid black;
            margin:10px auto;
            border-radius: 20px;

        }
        .wrapper1{
            width:580px;
            height:100%;
            margin:10px 10px 10px 10px;
            border-radius: 20px;
        }
        .form-group{
            margin:10px;
        }

        .clInput {
            float:left;
            margin:5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <title>Document</title>
</head>
<body>
    <h3> Mask blender v1.0</h3>
    <div class="wrapper">
        <div class="wrapper1">
        <form id="sendMask" method ="POST"  action="http://test.loc/api/mask" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" -->
            <div class="form-group">
                <label for="exampleInputEmail1">Color first mask</label>
                <input type="text" class="form-control" id="colorMask1" name="colorMask1" aria-describedby="emailHelp" value="#a8b9a8">
             <!--   <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Color second mask</label>
                <input type="text" class="form-control" id="colorMask2" name="colorMask2" aria-describedby="emailHelp" value="#d2a36f">
                <!--   <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">File for base</label>
                <input type="file" class="form-control-file" id="fileBase" name="fileBase"  >
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">File for first mask</label>
                <input type="file" class="form-control-file" id="fileMask1" name="fileMask1" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">File for second mask</label>
                <input type="file" class="form-control-file" id="fileMask2" name="fileMask2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">File for reflection</label>
                <input type="file" class="form-control-file" id="fileReflection" name="fileReflection">
            </div>
            <div class="form-group">
                <small id="emailHelp" class="form-text text-muted">Select blend method for first mask</small>
                    <select class="form-control form-control-sm" name="nameMethod1">
                        <option>Normal</option>
                        <option>Dissolve</option>
                        <option>Darken</option>
                        <option>Multiply</option>
                        <option>Color Burn</option>
                        <option>Linear Burn</option>
                        <option>Darker Color</option>
                        <option>Lighten</option>
                        <option>Screen</option>
                        <option>Color Dodge</option>
                        <option>Linear Dodge (Add)</option>
                        <option>Lighter Color</option>
                        <option>Overlay</option>
                        <option>Solf Light</option>
                        <option>Hard Light</option>
                        <option>Vivid Light</option>
                        <option>Linear Light</option>
                        <option>Pin Light</option>
                        <option>Hard Mix</option>
                        <option>Difference</option>
                        <option>Exclusion</option>
                        <option>Subtract</option>
                        <option>Hue</option>
                        <option>Saturation</option>
                        <option>Color</option>
                        <option>Luminosity</option>
                    </select>
            </div>
            <div class="form-group">
                <small id="emailHelp" class="form-text text-muted">Select blend method for second mask</small>
                <select class="form-control form-control-sm" name="nameMethod2">
                    <option>Normal</option>
                    <option>Dissolve</option>
                    <option>Darken</option>
                    <option>Multiply</option>
                    <option>Color Burn</option>
                    <option>Linear Burn</option>
                    <option>Darker Color</option>
                    <option>Lighten</option>
                    <option>Screen</option>
                    <option>Color Dodge</option>
                    <option>Linear Dodge (Add)</option>
                    <option>Lighter Color</option>
                    <option>Overlay</option>
                    <option>Solf Light</option>
                    <option>Hard Light</option>
                    <option>Vivid Light</option>
                    <option>Linear Light</option>
                    <option>Pin Light</option>
                    <option>Hard Mix</option>
                    <option>Difference</option>
                    <option>Exclusion</option>
                    <option>Subtract</option>
                    <option>Hue</option>
                    <option>Saturation</option>
                    <option>Color</option>
                    <option>Luminosity</option>
                </select>
            </div>

            <!--
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
            -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <script type="text/javascript">
            // чтоб не перезагружать данные формы отправляем
            // post fetch
            // можно сохранить данные формы в хранилище localStorage или sessionStorage
            // заменить данные формы из хранилища
            window.onload = function() {
                sendMask.addEventListener("submit", sendMaskClick, false);

                function sendMaskClick(event) {
                    event.preventDefault();


                    fetch('http://test.loc/api/mask', {
                        method: 'POST',
                        body: new FormData( document.getElementById('sendMask') )
                    });
                    // перезагружаем изображение;
                    setTimeout(resturtImage,3000);
                }

                function resturtImage(){
                    idP.innerHTML = "<img src='http://test.loc/api/mask' style='width:400px; height:400px;'  />";
                }
            }


        </script>
            <p id="idP">
                <img src="http://test.loc/api/mask" style="width:400px; height:400px;"  />
            </p>


        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
