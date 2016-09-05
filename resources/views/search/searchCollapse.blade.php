<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="refineSearchPanel">

    <h3 class="panel-title">
        <a class="collapsed" id="refineSearchButton" role="button" data-toggle="collapse" href="#refineSearch" aria-expanded="false" aria-controls="refineSearch">
        <i class="fa fa-search-plus"> </i> Cautare Noua
        </a>
    </h3>
  </div>
  <div id="refineSearch" class="panel-collapse collapse" role="tabpanel" aria-labelledby="refineSearchPanel">
  <div class="panel-body">
    @include('search.searchForm')
  </div>
  </div>
</div>