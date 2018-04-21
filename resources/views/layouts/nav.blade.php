<nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/"><span class="glyphicon glyphicon-home"
                                                              aria-hidden="true"></span> Home</a></li>
                <li><a href="/employees">
                        <span class="glyphicon glyphicon" aria-hidden="true"></span> All</a></li>
                <li><a href="#"><span class="fa fa-envelope-o"></span> Contact</a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span>
                        login</a></li>
            </ul>

            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span>--}}
                        {{--login</a></li>--}}
            {{--</ul>--}}


        </div>
    </div>
</nav>

<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
                <h4>Login</h4>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <label class="sr-only" for="email">Email</label><input type="text" class="form-control input-sm"
                                                                               placeholder="Email" id="email"
                                                                               name="email">
                    </div>
                    <br>
                    <div class="form-group">

                        <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control input-sm" placeholder="Password" id="password"
                               name="password"></div>
                    <br>


                    <button type="submit" class="btn btn-info btn">Sign in</button>
                    <button type="button" class="btn btn-default btn pull-right"  data-dismiss="modal">Cancel</button>


                </form>
            </div>

        </div>
    </div>
</div>