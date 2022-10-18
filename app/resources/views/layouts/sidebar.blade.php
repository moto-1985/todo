<div class="list-group"> 
    <a href="{{route('home')}}"
    class="list-group-item {{url()->current()==route('home')? 'active' : ''}}">
        <i class="fas fa-home pr-2"></i><span>一覧表示</span>
    </a>
    <a href="{{route('task.create')}}"
    class="list-group-item {{url()->current()==route('task.create')? 'active' : ''}}">
        <i class="fas fa-pen-nib pr-2"></i><span>新規投稿</span>
    </a>
    <a href="{{route('bookmark')}}"
    class="list-group-item {{url()->current()==route('bookmark')? 'active' : ''}}">
        <i class="fas fa-pen-nib pr-2"></i><span>ブックマーク一覧</span>
    </a>
</div>