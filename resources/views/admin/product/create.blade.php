<div wire:ignore.self class="modal fade" id="staticBackdropArticle" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabelArticle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelArticle">Продукты</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-block">Выберите категории</label>
                    <select class="js-example-basic-multiple" wire:model="category_id" placeholder="input input">
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->title}} -- <p>⥈</p></option>
                            @foreach ($item->categoriesRelationship as $key)
                                <option class="text-success" value="{{$key->id}}">
                                   <p>➥</p>
                                      {{$key->title}}
                                </option>

                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Название</label>
                    <input type="text" class="form-control" wire:model.lazy="name" placeholder="Название">
                </div>

                <div class="form-group">
                    <label for="">Описание</label>
                    <textarea class="form-control" wire:model.lazy="description"></textarea>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="create()">Сохранить</button>
            </div>
        </div>
    </div>
</div>
