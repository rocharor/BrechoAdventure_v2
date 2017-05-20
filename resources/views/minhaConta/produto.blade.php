@extends('template')
@section('content')

    <link type="text/css" rel="stylesheet" href="/css/produto.css" />

    <ol class="breadcrumb">
        <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
		<li class="active">Meus Produtos</li>
	</ol>

    <div class="row el-produtos-minha-conta hide">
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-md-3 col-xs-12 div-meus-produtos" align="center">
                    @if ($produto->deleted_at)
                        <p><span class="label label-danger">Produto exclu&iacute;do</span></p>
                    @elseif ($produto->status == 1)
                        <p><span class="label label-success">Data de cadastro: <b>{{ $produto->dataExibicao }}</b></span></p>
                    @else
                        <p><span class="label label-warning"><b>Aguardando aprovação</b></span></p>
                    @endif

                    <div class="titulo"><b>{{$produto->titulo}}</b></div>
                    <div class='div_imagem'>
                        <img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}">
                    </div>

                    <br />
                    @if ($produto->status == 1 && $produto->deleted_at == null)
                        <div class='btn_acoes'>
                            {{-- <div><a href="/minha-conta/produto/editar-produto/{{ $produto->idCodificado }}" class="btn btn-primary" data-produto-id="{$produto.id}"><span class='glyphicon glyphicon-pencil'></span></a></div> --}}
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->idCodificado) }}" class="btn btn-primary" data-produto-id="{$produto.id}"><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><button class="btn btn-danger" onclick="excluir_produto({{ $produto->id }})"><span class='glyphicon glyphicon-remove'></span></button></div>
                            {{-- <div><a href="/produto/visualizarProduto/{{ $produto->idCodificado }}'" class="btn btn-info"><span class='glyphicon glyphicon-eye-open'></span></a></div> --}}
                            <div><a href="{{ Route('visualizarProduto',$produto->idCodificado) }}" class="btn btn-info"><span class='glyphicon glyphicon-eye-open'></span></a></div>
                            <div><button class="btn  btn-warning favorito"><div class="favorito-ativo"></div> - {{ $produto->qtd_favorito }}</button></div>
                        </div>
                    @else
                        <div class='btn_acoes'>
                            <div><button class="btn btn-primary" disabled><span class='glyphicon glyphicon-pencil'></span></button></div>
                            <div><button class="btn btn-danger" disabled><span class='glyphicon glyphicon-remove'></span></button></div>
                            <div><button class="btn btn-info" disabled><span class='glyphicon glyphicon-eye-open'></span></button></div>
                            <div><button class="btn btn-warning favorito" disabled><div class="favorito-inativo"></div></button></div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <!--PAGINAÇÃO-->
	@include('paginacao')

    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
