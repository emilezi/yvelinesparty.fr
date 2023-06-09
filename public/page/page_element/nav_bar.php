<!-- Navigation bar -->

<nav class="uk-navbar-container uk-padding-small" uk-navbar>

    <div class="nav-overlay uk-navbar-left">

        <a class="uk-navbar-item uk-logo" href="index.php">Yvelines party</a>

        <a class="uk-navbar-item uk-logo" href="index.php?page=user">Compte</a>

    </div>

    <div class="nav-overlay uk-navbar-right">

        <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade"></a>

    </div>

    <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

        <div class="uk-navbar-item uk-width-expand" >
            <form class="uk-search uk-search-navbar uk-width-1-1" method='get' action='index.php'>
                <input class="uk-search-input" type="search" name='q' placeholder="Rechercher" aria-label="Search" autofocus>
            </form>
        </div>

        <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade"></a>

    </div>

</nav>