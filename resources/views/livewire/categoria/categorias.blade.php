<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Gerenciar Categorias 
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
                            <p class="text-sm bg-green-500">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()"
                class="px-4 py-2 my-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Criar Nova
                Categoria</button>
            @if ($isOpen)
                @include('livewire.categoria.create')
            @endif
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Descrição</th>
                        <th class="px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-4 py-2 border">{{ $categoria->id }}</td>
                            <td class="px-4 py-2 border">{{ $categoria->nome}}</td>
                            <td class="px-4 py-2 border">{{ $categoria->descricao }}</td>
                            <td class="px-4 py-2 border">
                                <button wire:click="edit({{ $categoria->id }})"
                                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Editar</button>
                                <button wire:click="delete({{ $categoria->id }})"
                                    class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Deletar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-12">
        {{$categorias->links()}}
    </div>
        </div>
    </div>
</div>