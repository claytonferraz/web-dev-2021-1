<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Gerenciar Produtos 
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
                <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()"
                class="flex px-6 py-2 my-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                <svg class="mr-2 group-hover:text-light-blue-600 text-light-blue-500" width="16" height="20" fill="currentColor">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
      </svg>Cadastrar </button>
      
            @if ($isOpen)
                @include('livewire.produtos.create')
            @endif
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Descrição</th>
                        <th class="px-4 py-2">Preço</th>
                        <th class="px-4 py-2">Categoria</th>
                        <th class="px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $pro)
                        <tr>
                            <td class="px-4 py-2 border">{{ $pro->id }}</td>
                            <td class="px-4 py-2 border">{{ $pro->nome}}</td>
                            <td class="px-4 py-2 border">{{ $pro->descricao }}</td>
                            <td class="px-4 py-2 border"> {{ 'R$ ' }}{{ $pro->preco }}</td>
                            <td class="px-4 py-2 border">{{ $pro->categoria->nome}}</td>
                            <td class="px-4 py-2 border">
                                <button wire:click="edit({{ $pro->id }})"
                                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    
                                    Editar</button>
                                <button wire:click="delete({{ $pro->id }})"
                                    class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Deletar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-12">
        {{$produtos->links()}}
    </div>
        </div>
    </div>
</div>