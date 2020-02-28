

@if (Auth::user()->isfavoring($topic->id))
      <form id="favorite_form_destroy" action="{{ route('favorites.destroy', $topic->id) }}"     method="post" style="display: inline; ">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a href="javascript:document:favorite_form_destroy.submit();"
        style="text-decoration:none; color: #5c75ef;">
          <i class="fa fa-heart" aria-hidden="true"></i>
              {{ $topic->favorite_count }}
        </a>
      </form>
  @else
      <form id="favorite_form_store" action="{{ route('favorites.store', $topic->id) }}"
      method="post" style="display: inline;">
        {{ csrf_field() }}
        <a href="javascript:document:favorite_form_store.submit();"
        style="text-decoration:none; color: gray;">
          <i class="fa fa-heart-o" aria-hidden="true"></i>
              {{ $topic->favorite_count }}
        </a>
      </form>
@endif
