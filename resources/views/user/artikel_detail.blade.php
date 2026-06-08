@extends('user.layouts.app')

@section('title', 'Detail Artikel - INDETA')

@section('content')
    <main class="flex-1 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative">
        <!-- Back Button -->
        <a href="/artikel" class="inline-flex items-center text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors mb-8">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Artikel
        </a>

        <!-- Loading State -->
        <div id="loading-state" class="text-center py-20">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#3e2723] border-t-2"></div>
            <p class="mt-4 text-gray-600 font-medium">Memuat artikel...</p>
        </div>

        <!-- Content Area -->
        <article id="content-area" class="hidden">
            <div class="flex flex-col md:flex-row md:items-start gap-8 lg:gap-12">
                <!-- Left: Sticky Hero Image -->
                <div class="w-full md:w-5/12 lg:w-4/12 md:sticky md:top-28">
                    <div class="w-full aspect-square md:aspect-[3/4] rounded-2xl overflow-hidden shadow-lg bg-[#e0d9c8]">
                        <img id="art-image" src="" alt="Cover Artikel" class="w-full h-full object-cover hidden transition-opacity duration-500">
                    </div>
                </div>

                <!-- Right: Text Content -->
                <div class="w-full md:w-7/12 lg:w-8/12 flex flex-col">
                    <!-- Title & Prolog -->
                    <header class="mb-8 text-center md:text-left">
                        <h1 id="art-title" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#3e2723] mb-4 leading-tight"></h1>
                        <p id="art-prolog" class="text-gray-600 text-lg md:text-xl leading-relaxed italic"></p>
                    </header>

                    <!-- Main Text -->
                    <div class="prose prose-lg max-w-none text-gray-800">
                        <div id="art-content" class="text-base md:text-lg leading-loose whitespace-pre-line text-justify space-y-6"></div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Not Found -->
        <div id="not-found" class="hidden text-center py-20 text-gray-600">
            <h2 class="text-2xl font-bold mb-2">Artikel Tidak Ditemukan</h2>
            <p>Maaf, artikel yang Anda cari tidak tersedia atau mungkin telah dihapus.</p>
            <a href="/artikel" class="inline-block mt-6 px-6 py-2 bg-[#d6d6a8] text-[#3e2723] font-bold rounded-lg hover:bg-[#c2c290] transition-colors">Kembali ke Artikel</a>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
      const CURRENT_SLUG = "{{ $slug }}";

      async function fetchArticleDetail() {
        if (!supabaseClient) return;

        const { data: articles, error } = await supabaseClient
          .from('articles')
          .select('*')
          .eq('slug', CURRENT_SLUG)
          .limit(1);

        const loadingState = document.getElementById('loading-state');
        const contentArea = document.getElementById('content-area');
        const notFound = document.getElementById('not-found');

        if (error || !articles || articles.length === 0) {
            loadingState.classList.add('hidden');
            notFound.classList.remove('hidden');
            return;
        }

        const article = articles[0];

        // Update UI
        document.getElementById('art-title').textContent = article.title;
        document.getElementById('art-prolog').textContent = article.prolog || '';
        document.getElementById('art-content').textContent = article.content || '';

        // Image handling
        const imgEl = document.getElementById('art-image');
        if (article.thumbnail) {
            let finalImg = article.thumbnail.startsWith('http') 
                ? article.thumbnail 
                : `${window.SUPABASE_URL}/storage/v1/object/public/articles/${article.thumbnail}`;
            imgEl.src = finalImg;
            imgEl.onload = () => {
                imgEl.classList.remove('hidden');
                imgEl.classList.add('opacity-100');
            };
        }

        loadingState.classList.add('hidden');
        contentArea.classList.remove('hidden');
      }

      fetchArticleDetail();
    </script>
@endsection
