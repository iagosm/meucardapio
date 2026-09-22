<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rota temporária com dados falsos, só para visualizar a view. Remover quando o controller real existir.
Route::get('/cardapio', function () {
    $categorias = collect([
        (object) [
            'id' => 1,
            'nome' => 'Lanches',
            'produtos' => collect([
                (object) ['id' => 1, 'nome' => 'Hut Burger Bacon', 'descricao' => 'Pão brioche, cheddar, bacon e molho da casa', 'preco' => 26.90, 'imagem' => null, 'destaque' => true, 'disponivel' => true],
                (object) ['id' => 2, 'nome' => 'Hut Burger Duplo', 'descricao' => 'Dois blends, cheddar duplo e picles', 'preco' => 32.90, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
                (object) ['id' => 3, 'nome' => 'Cheeseburger Clássico', 'descricao' => 'Blend, queijo, alface e tomate', 'preco' => 21.90, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
            ]),
        ],
        (object) [
            'id' => 2,
            'nome' => 'Açaí',
            'produtos' => collect([
                (object) ['id' => 4, 'nome' => 'Açaí 500ml', 'descricao' => 'Granola, banana e leite em pó', 'preco' => 18.00, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
                (object) ['id' => 5, 'nome' => 'Açaí 300ml', 'descricao' => 'Granola e morango', 'preco' => 13.00, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
            ]),
        ],
        (object) [
            'id' => 3,
            'nome' => 'Batatas',
            'produtos' => collect([
                (object) ['id' => 6, 'nome' => 'Batata com calabresa', 'descricao' => 'Porção generosa com queijo', 'preco' => 22.00, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
            ]),
        ],
        (object) [
            'id' => 4,
            'nome' => 'Bebidas',
            'produtos' => collect([
                (object) ['id' => 7, 'nome' => 'Água de coco', 'descricao' => '300ml, gelada', 'preco' => 7.00, 'imagem' => null, 'destaque' => false, 'disponivel' => true],
            ]),
        ],
    ]);

    return view('cardapio.index', [
        'categorias' => $categorias,
        'lojaAberta' => true,
        'fechaAs' => '23h',
        'bairroLoja' => 'Itapuã',
        'enderecoLoja' => 'Rua das Palmeiras, 120 — Itapuã',
        'telefoneLoja' => '(11) 91234-5678',
        'formasPagamento' => 'Dinheiro, Pix, cartão de crédito e débito',
        'bannerLoja' => null,
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
