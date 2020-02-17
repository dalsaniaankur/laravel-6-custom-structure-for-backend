<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name='robots' content='index,follow'>
<meta name="url" content="{{ url()->current() }}">
<meta name="identifier-URL" content="{{ url()->current() }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@Kidrend">
<meta name="twitter:url" content="{{ url()->current() }}">

@if(!empty( $metaTitle ))
<meta name="title" content="{{ $metaTitle }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta itemprop="name" content="{{ $metaTitle }}">
@endif
@if(!empty( $metaKeyword ))
<meta name="keywords" content="{{ $metaKeyword }}">
@endif
@if(!empty( $metaDescription ))
<meta name="description" content="{{ $metaDescription }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
@endif
@if(!empty($metaImage))
<meta property="og:image" content="{{ $metaImage }}">
<meta itemprop="image" content="{{ $metaImage }}">
<meta name="twitter:image" content="{{ $metaImage }}">
@endif
