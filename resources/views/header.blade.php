{{-- WEB --}}
<div class="menu hidden-xs">
    <div class='topo_esquerdo '>
        <img src="/images/logo.jpg" alt="Brecho Aventure" class='img_logo'>
        <nav class="links">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'produtos' ? 'class=active' : '' }} href="{{ Route('product') }}">Produtos</a>
            <a {{ Request::route()->getName() == 'contact' ? 'class=active' : '' }} href="{{ Route('contact') }}">Fale conosco</a>
        </nav>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <div>
                <a href='/login' class="btn btn-login">Login</a>
                <a href='/cadastre-se' class="btn btn-cadastro">Cadastre-se</a>
            </div>
        @else
            <nav class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/profile/{{ Auth::user()->nome_imagem}}" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="mask img-circle" align='center'><span class="">Minha <br />Conta</span></div>
                </a>
                <ul class="dropdown-menu menu_logado">
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.create-produto' ? 'class=active' : '' }} href="{{ Route('minha-conta.product-create') }}">Cadastrar Produto</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.profile' ? 'class=active' : '' }} href="{{ Route('minha-conta.profile') }}">Meu Perfil</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.meus-produto' ? 'class=active' : '' }} href="{{ Route('minha-conta.my-product') }}">Meus Produtos</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.meus-favorito' ? 'class=active' : '' }} href="{{ Route('minha-conta.meus-favorito') }}">Meus Favoritos</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.mensagem' ? 'class=active' : '' }} href="{{ Route('minha-conta.mensagem') }}">Mensagens - <span class='qtdMsg'>0</span></a>
                    </li>
                    @can('pg-admin')
                        <li><a href="{{ Route('admin.home') }}">Admin</a></li>
                    @endcan
                    <li><a href='/logout' style="font-weight:bold;color:#CD3333;">Sair</a></li>
                </ul>
            </nav>
        @endif
    </div>
</div>

{{-- MOBILE --}}
<div class="menu-mobile hidden-sm hidden-md hidden-lg">
    <div class='topo_esquerdo '>
        <img src="/images/logo.jpg" alt="Brecho Aventure" class='img_logo_mobile hidden-sm hidden-md hidden-lg'>
        <nav class="links" style="font-size:7px">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'produtos' ? 'class=active' : '' }} href="{{ Route('product',1) }}">Produtos</a>
            <a {{ Request::route()->getName() == 'contact' ? 'class=active' : '' }} href="{{ Route('contact') }}">Fale conosco</a>
        </nav>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <div class="dropdown">
            	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            		<span class="glyphicon glyphicon-menu-hamburger"></span>
            	</button>
            	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin: 2px -120px 0;">
                    <li><a href='/login' >Login</a></li>
                    <li><a href='/cadastre-se'>Cadastre-se</a></li>
            	</ul>
            </div>
        @else
            <nav class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/profile/{{ Auth::user()->nome_imagem}}" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="img-circle" align='center'></div>
                </a>
                <ul class="dropdown-menu menu_logado">
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.create-produto' ? 'class=active' : '' }} href="{{ Route('minha-conta.product-create') }}">Cadastrar Produtos</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.profile' ? 'class=active' : '' }} href="{{ Route('minha-conta.profile') }}">Meu Perfil</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.meus-produto' ? 'class=active' : '' }} href="{{ Route('minha-conta.my-product') }}">Meus Produtos</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.meus-favorito' ? 'class=active' : '' }} href="{{ Route('minha-conta.meus-favorito') }}">Meus Favoritos</a>
                    </li>
                    <li>
                        <a {{ Request::route()->getName() == 'minha-conta.mensagem' ? 'class=active' : '' }} href="{{ Route('minha-conta.mensagem') }}">Mensagens - <span class='qtdMsg'>0</span></a>
                    </li>
                    @can('pg-admin')
                        <li><a href="{{ Route('admin.home') }}">Admin</a></li>
                    @endcan
                    <li><a href='/logout' style="font-weight:bold;color:#CD3333;">Sair</a></li>
                </ul>
            </nav>
        @endif
    </div>
</div>


<!-- BANNER -->
@if(Request::route()->getName() == 'home')
    {{-- Banner Web --}}
    <div class="banner-web">
        <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/images/banner.jpg" alt="Brechó Adventure">
                </div>
                <div class="item">
                    <img src="/images/banner2.jpg" alt="Brechó Adventure">
                </div>
                <div class="item">
                    <img src="/images/banner3.jpg" alt="Brechó Adventure">
                </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    {{-- Banner Mobile --}}
    <div class="banner-mobile">
        <div id="carousel-example-generic" class="carousel slide hidden-sm hidden-md hidden-lg" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/images/banner.jpg" alt="Brechó Adventure">
                </div>
                <div class="item">
                    <img src="/images/banner2.jpg" alt="Brechó Adventure">
                </div>
                <div class="item">
                    <img src="/images/banner3.jpg" alt="Brechó Adventure">
                </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endif




<!-- BUSCA -->
{{-- <div class='campo-buscar'>
    <div class="input-group hidden-xs">
    	<input type="text" class="form-control busca" placeholder="Buscar">
    	<div class="btn-group input-group-btn">
    		<button class="btn btn-primary">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
    		</button>
    	</div>
    </div>
</div> --}}

{{-- <script type="text/javascript">
    if (!empty({{ Auth::check() }})) {buscaNotificacao();}
</script> --}}
