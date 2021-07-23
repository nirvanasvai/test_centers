<div wire:ignore.self class="modal fade" id="exampleModalCategory" tabindex="-1" aria-labelledby="exampleModalLabelCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelCategory">Категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Название Категории</label>
                        <input type="text" class="form-control" wire:model="title" placeholder="Категория">

                </div>
                <div class="form-group">
                    <label for="" >Родительская категория</label>
                    <select class="form-control" wire:model="category_id">
                        <option value="">-- без родительской категории --</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}" @if(isset($select) && $item->id == $select) selected @endif>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="create()">Сохранить</button>
            </div>
        </div>
    </div>
</div>
