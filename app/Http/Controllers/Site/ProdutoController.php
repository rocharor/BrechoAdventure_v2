<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Services\Util;

class ProdutoController extends Controller
{
    use Util;

    public $model;
    public $totalPagina = 5;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Favorito $favorito)
    {
        $produtos = $this->model->getProdutos(9);
        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/produto',['produtos'=>$produtos]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todosProdutosIndex($pg, Favorito $favorito)
    {
        $totalProdutos = count($this->model->getProdutos());
        $paginacao = (int)ceil($totalProdutos / $this->totalPagina);

        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        $produtos = $this->model->getProdutos($limit['inicio'],$limit['fim']);
        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/todosProdutos',['produtos'=>$produtos,'pg'=>$pg,'totalProdutos'=>$paginacao]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMC()
    {
        $meusProdutos = $this->model->getMeusProdutos();

        foreach($meusProdutos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            // $produto->favorito = false;
            // foreach($favoritos as $favorito){
                // if($favorito->produto_id == $produto->id){
                    // $produto->favorito = true;
                // }
            // }
        }

        return view('minhaConta/produto',['meusProdutos'=>$meusProdutos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastroIndex(Categoria $categoria)
    {
        $autorizado = false;
        if(Auth::user()->dt_nascimento && (Auth::user()->telefone_fixo || Auth::user()->telefone_cel)){
            $autorizado = true;
        }

        $categorias = $categoria->all();

        return view('minhaConta/cadastroProduto',['autorizado'=>$autorizado,'categorias'=>$categorias]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


            $foto_salva = false;
            $nome_imagem = [];

            foreach($request->foto as $key=>$foto){
                // if ($foto->hasFile('foto') &&  $foto->file('foto')->isValid()){
                    $ext = $foto->extension();
                    if($this->validaExtImagem($ext)){
                        $user_id = Auth::user()->id;
                        $foto_nome = $key . '_' . $user_id . '_' . date('dmYhis') . '.' . $ext;
                        $foto_salva = $foto->move(public_path("imagens\produtos"), $foto_nome);
                        $nome_imagem[] = $foto_nome;
                    }
                // }

        }

        if ($foto_salva) {
            $this->model->user_id = $user_id;
            $this->model->categoria_id = $request->get('categoria');
            $this->model->titulo = $request->get('titulo');
            $this->model->descricao = $request->get('descricao');
            $this->model->valor = $request->get('valor');
            $this->model->estado = $request->get('tipo');
            $this->model->nm_imagem = implode('|',$nome_imagem);
            if($this->model->save()){
                return redirect()->route('minha-conta.cadastro-produto')->with('sucesso','Produro inserido com sucesso.');
            }
        }

        return redirect()->route('minha-conta.cadastro-produto')->with('erro','Erro ao salvar produto, tente novamente!');

        // $arquivo_file = $request->file('imagemPerfil');
        // $foto_salva = false;
        // if ($request->hasFile('imagemPerfil') && $request->file('imagemPerfil')->isValid()){
        //     $ext = $request->imagemPerfil->extension();
        //     if($this->validaExtImagem($ext)){
        //         // $path = $request->imagemPerfil->store('imagens/cadastro'); /* envia as imagens para a pasta Storage/app*/
        //         // $path = $request->imagemPerfil->storeAs('imagens/cadastro', $foto_nome); /*mesma coisa só que pode setar o nome*/
        //         $foto_nome = Auth::user()->id . '_' . date('d-m-Y_h_i_s') . '.' . $ext;
        //         $foto_salva = $request->imagemPerfil->move(public_path("imagens\cadastro"), $foto_nome);
        //     }
        // }
        //
        // if ($foto_salva) {
        //     $imagemAntiga = Auth::user()->nome_imagem;
        //     if($imagemAntiga != 'padrao.jpg'){
        //         $filename = public_path("imagens\cadastro\\" . $imagemAntiga);
        //         File::delete($filename);
        //     }
        //
        //     $r = $user->find(Auth::user()->id);
        //     $ret =  $r->update(['nome_imagem'=>$foto_nome]);
        //         if ($ret) {
        //             return redirect()->route('minha-conta.mcperfil')->with('sucesso','Foto alterada com sucesso.');
        //         }
        // }
        //
        // return redirect()->route('minha-conta.mcperfil')->with('erro','Erro ao alterar imagem , tente novamente!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Traz os dados do produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $produto_id = $request->get('produto_id');
        $produtos = $this->model->getDescricaoProduto($produto_id);

        //echo response($produtos)->content();
        echo response()->json($produtos)->content();
        die();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Categoria $categoria)
    {
        $produto = $this->model->find($id);
        $categorias = $categoria->all();

        $imagens = explode('|',$produto->nm_imagem);
        
        $produto->imagens = $imagens;

        return view('minhaConta/editarProduto',['categorias'=>$categorias,'produto'=>$produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}