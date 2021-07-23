<div>
    <div class="container">
        <br>
        <h2>Продукты</h2>
        <hr/>

        @include('components.message')


        <div class="row">
            <div class="col-12">
                <div class="card bg-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="" class="btn btn-primary mb-2" role="button" data-toggle="modal" data-target="#staticBackdropArticle"><i class="far fa-plus-square"></i> Создать</a>
                            </div>
                            @include('admin.product.create')
                            <div class="col-md-6">
                                <form style="display: flex; justify-content: flex-end;">
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="paginate">
                                            <option value="">Количество строк</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="category_filter" id="category" required
                                                style="margin-left:10px;">
                                            <option value="">Все категории</option>
                                            @foreach($categories as $category)

                                                <option value="{{$category->id}}">{{$category->title}} - <p>⥈</p></option>
                                                @foreach($category->categoriesRelationship as $item)
                                                    <option class="text-success" value="{{$item->id}}"><p>➥</p>{{$item->title}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="search" wire:model="search" class="form-control ml-3" placeholder="Поиск">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th >
                                        <div class="form-group">
                                            <select class="custom-select" wire:model="orderBy">
                                                <option value="1">A-Z</option>
                                                <option value="2">Z-A</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>Наименование</th>
                                    <th class="text-right">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ ($products ->currentpage()-1) * $products ->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ $item->name }}</td>

                                        <td class="text-right">

                                            <a class="btn btn-warning" role="button" data-toggle="modal" data-target="#staticBackdropArticle" wire:click="edit({{$item->id}})"><i class="fa fa-edit"></i></a>

                                            <button type="submit" class="btn btn-danger" onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" wire:click="destroy({{$item->id}})"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                            <div class="py-4">
                                {{$products->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
