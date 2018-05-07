<nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">

    <div class="container">

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"
                                                     aria-hidden="true"></span> Home</a></li>
                <li><a href="{{ route('employees') }}">
                        <span class="glyphicon  glyphicon-user" aria-hidden="true"></span> All</a></li>

                <li><a href="{{ route('createForm') }}">
                        <span class="glyphicon  glyphicon-plus" aria-hidden="true"></span> Create</a></li>

                <li><a href="//www.work.ua/resumes/4774041/"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>


            </ul>

            @guest
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>
                            login</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle glyphicon glyphicon-log-out" data-toggle="dropdown" role="button" aria-expanded="false"
                           aria-haspopup="true" v-pre>
                            <h7>{{ Auth::user()->name }}</h7> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endguest

        </div>
    </div>
</nav>
