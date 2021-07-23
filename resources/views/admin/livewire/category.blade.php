<div>
    <div class="container">
        <br>
        <h2>Список категорий</h2>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="" role="button" data-toggle="modal" data-target="#exampleModalCategory"
                           class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                        {{--                        @if ($isOpen)--}}
                        @include('admin.category.create')
                        {{--                        @endif--}}


                        <div class="table-responsive">
                            @include('components.message')
                            <table id="zero_config" class="table table-striped table-dark">
                                <thead>
                                <tr class="bg-success">
                                    <th>#</th>
                                    <th>Наименование</th>
                                    <th class="text-center">Кол-во Продуктов</th>
                                    @if(!$category_id)
                                        <th class="text-center" colspan="2">Подкатегории</th>
                                    @endif
                                    <th class="text-right">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $item)

                                    <tr>
                                        <th scope="row">
                                            {{ ($categories ->currentpage()-1) * $categories ->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{$item->title}}</td>

                                        <td class="text-center">
                                            @if(isset($item->productsRelationship) && $item->categoriesRelationship->count() > 0)
                                                {{ ($categories ->count()) * $categories ->count() + $loop->index + $item->count() }}

                                            @else
                                                @if(isset($item->productsRelationship) && $item->productsRelationship->count() > 0)
                                                    {{  $item->productsRelationship->count()  }}
                                                @else
                                                    {{'Нет Продуктов'}}
                                                @endif
                                            @endif
                                        </td>
                                        @if(!$category_id)
                                            <td class="text-center">
                                                @if(isset($item->categoriesRelationship) && $item->categoriesRelationship->count() > 0)  {{ 'количество: '. $item->categoriesRelationship->count()  }}
                                                @else {{'Нет подкатегорий'}}  @endif
                                            </td>
                                            <td>
                                                <a href="/admin/category?category_id={{$item->id}}">редактировать</a>
                                            </td>
                                        @endif
                                        <td class="text-right">
                                            <a onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            >

                                                <a class="btn btn-warning " href=""><i class="fa fa-edit"></i></a>

                                                <button type="submit" wire:click="destroy({{ $item->id }})"
                                                        class="btn btn-danger"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </a>
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
                                {{$categories->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
