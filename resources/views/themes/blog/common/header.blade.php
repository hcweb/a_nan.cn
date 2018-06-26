<nav class="navbar navbar-expand-lg bg-white fixed-top" color-on-scroll="500" style="z-index: 1033;">
    <div class="container">


        <div class="navbar-translate">
            <a class="navbar-brand" href="/">
                {{config('web-config.siteTitle')}}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" data-nav-image="./assets/img/blurred-image-1.jpg" data-color="orange">
            <ul class="navbar-nav ml-auto">


                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">首页
                    </a>
                </li>
                @foreach($categorys as $v)
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#">
                            {{$v->title}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>