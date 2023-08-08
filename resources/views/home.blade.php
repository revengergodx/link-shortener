<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Make your short link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="mt-5">
            <div class="d-flex justify-content-center mb-5">
                <form class="col-8 d-flex justify-content-center" action="{{ route('link.cut') }}" method="post">
                    @csrf
                    <input style="margin-right: 3px" class="w-75" type="text" name="full_link"
                           placeholder="Enter your link">
                    <button class="btn btn-primary">Cut</button>
                </form>
            </div>
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            @if(isset($existsLink[0]))
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <h3>Your short link:&nbsp;<span
                                class="me-3">http://127.0.0.1:8000/{{ $existsLink[0]->short_link }}</span><input
                                type="hidden" id="short_link"
                                value="http://127.0.0.1:8000/{{ $existsLink[0]->short_link }}">
                            <button onclick="copyText()" class="btn btn-success">Copy</button>
                        </h3>
                    </div>
                </div>
            @endif
            @if(isset($newLink[0]))
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <h3>Your short link:&nbsp;<span
                                class="me-3">http://127.0.0.1:8000/{{ $newLink[0]->short_link }}</span><input
                                type="hidden" id="short_link"
                                value="http://127.0.0.1:8000/{{ $newLink[0]->short_link }}">
                            <button id="copy" onclick="copyText()" class="btn btn-success">Copy</button>
                        </h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    function copyText() {
        let copyText = document.getElementById("short_link");
        copyText.select();
        navigator.clipboard.writeText(copyText.value);
        alert("Copied the text: " + copyText.value);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>
