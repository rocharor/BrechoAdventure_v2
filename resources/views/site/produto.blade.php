@extends('template')
@section('content')
<link type="text/css" rel="stylesheet" href="/css/produto.css" />

<style type="text/css">
	.img-ativo  {
	    background-image: url(/imagens/favorito_ativo.jpg);
	    background-size: cover;
	    width: 20px;
	    height: 20px;
		display:block;
	}
	.img-inativo  {
	    background-image: url(/imagens/favorito_inativo.jpg);
	    background-size: cover;
	    width: 20px;
	    height: 20px;
	    display:block;
	}
</style>

<ol class="breadcrumb">
	<li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
	<li class="active">Produtos</li>
</ol>

@if(count($produtos) == 0)
	<div class="well" align="center"><b><i>N&atilde;o existe nenhum produto cadastrado</i></b></div>
@else
	<div class="row" >
		<h1 class="text-success" align="center">Ultimos produtos adicionados</h1>
		@foreach($produtos as $produto)
	        <div class="col-md-4" align="center" style="border-bottom: solid 1px; padding: 20px 0">
	        <div class="div-produto" align="center">
	            <div class="div-favorito-{$produto.id}" data-usuario-id="{$usuario_id}">
	                @if ($logado == 0)
	                    <a class="act-favorito-deslogado"><img src="/imagens/favorito_inativo.jpg" alt="" style="width: 20px;"></a>
	                @else
	                    {if $produto.favorito eq 1}
	                        <a class="act-favorito favorito-ativo-{$produto.id}" data-produto-id='{$produto.id}' data-status='0'>
	                            <span class="img-ativo"></span>
	                        </a>
	                    {else}
	                        <a class="act-favorito favorito-inativo-{$produto.id}" data-produto-id='{$produto.id}' data-status='1'>
	                            <span class="img-inativo"></span>
	                        </a>
	                    {/if}
	                @endif
	            </div>
	            <div style="width: 300px; height: 20px;" align="center">
	                <b>{$produto.titulo}</b>
	            </div>
	            <div style="width: 250px; height: 250px;">
	                <img class="img-thumbnail" src="/imagens/produtos/{$produto.img_principal}" alt="" style="width: 100%; height: 100%;">
	            </div>
	            <div><b>Pre&ccedil;o: R$ {$produto.valor}</b></div>
	            <div><button style="width:100%;" class='btn btn-warning act-descricao' data-id="{$produto.id}"><b>Ver detalhes</b></button></div>
	        </div>
	        </div>
		@endforeach
	</div>
	<br><br>
	<div align="center">
		<a href="/produto/todosProdutos/pg/1/" class="btn btn-primary" style="width: 50%">VER TODOS</a>
	</div>
@endif



<!--Modal descricao-->
<div class="modal fade" id='modal_descricao'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body" >
                <h2 align="center"><span id='titulo'></span></h2>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators indicadores">
				  		<!-- INDICADORES -->
				  	</ol>
                    <div class="carousel-inner produto_fotos" id='fotos' role="listbox">
                    	<div class='item active'></div>
                        <!-- IMAGENS -->
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
                <hr>
                <p><label>Titulo: &nbsp;</label><span class='produto_titulo'></span></p>
                <p><label>Descrição: &nbsp;</label><span class='produto_descricao'></span></p>
                <p><label>Estado: &nbsp;</label><span class='produto_estado'></span></p>
                <p><label>Preço: &nbsp;</label><span class='produto_valor'></span></p>
                <hr>
                <p><label>Nome: &nbsp;</label><span class='produto_nome'></span></p>
                <p><label>Email: &nbsp;</label><span class='produto_email'></span></p>
                <p><label>Telefones: &nbsp;</label><span class='produto_telefone'></span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/produto.js"></script>
<script type="text/javascript" src="/js/minhaConta/meusFavorito.js"></script>
@stop
