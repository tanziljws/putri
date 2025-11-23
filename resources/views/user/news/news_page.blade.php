@extends('layouts.user.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

.berita-hero {
    background: #ffffff;
    padding: 4rem 0;
    text-align: center;
    margin-bottom: 3rem;
    border-bottom: 3px solid #4f7cff;
}

.berita-breadcrumb {
    font-size: 0.875rem;
    color: #6b7280;
    text-align: left;
    margin-bottom: 1rem;
}

.berita-breadcrumb a {
    color: #2563eb;
    text-decoration: none;
}

.berita-breadcrumb a:hover {
    text-decoration: underline;
}

.berita-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.berita-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.berita-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin: 3rem 0;
}

.berita-card {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.berita-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.berita-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.berita-card:hover .berita-image img {
    transform: scale(1.05);
}

.berita-content {
    padding: 1.5rem;
}

.berita-date {
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
}

.berita-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.berita-excerpt {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-readmore-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    margin-top: 0.25rem;
    transition: color 0.2s ease, transform 0.2s ease;
}

.berita-readmore-btn i {
    font-size: 0.85rem;
    transition: transform 0.2s ease;
}

.berita-readmore-btn:hover {
    color: #1d4ed8;
    transform: translateX(2px);
}

.berita-readmore-btn:hover i {
    transform: translateX(2px);
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

.pagination .page-link {
    color: #4f7cff;
    border: 1px solid #e5e7eb;
    margin: 0 0.25rem;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #4f7cff;
    border-color: #4f7cff;
    color: white;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
}

@media (max-width: 768px) {
    .berita-grid {
        grid-template-columns: 1fr;
    }
    
    .berita-hero h1 {
        font-size: 2rem;
    }
}
</style>

<!-- Header + Breadcrumb Berita -->
<div class="berita-hero">
    <div class="berita-container">
        <nav class="berita-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('user.dashboard') }}">Beranda</a>
            <span> / </span>
            <span>Berita Terkini</span>
        </nav>
        <h1>
            <i class="fas fa-newspaper"></i> Berita Terkini
        </h1>
        <p>Ikuti berita dan informasi terbaru dari kami</p>
    </div>
</div>

<!-- Berita Grid -->
<div class="berita-container">
    <div class="berita-grid">
        @forelse($news as $item)
            <div class="berita-card">
                <div class="berita-image">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                        <img src="{{ asset('images/default-news.jpg') }}" alt="Default News">
                    @endif
                </div>
                <div class="berita-content">
                    <div class="berita-date">
                        <i class="far fa-calendar-alt"></i> 
                        {{ $item->published_date ? $item->published_date->format('d M Y') : $item->created_at->format('d M Y') }}
                    </div>
                    <h3 class="berita-title">{{ $item->title }}</h3>
                    <p class="berita-excerpt">
                        {{ Str::limit(strip_tags($item->content), 150) }}
                    </p>
                    <a href="{{ route('user.news.show', $item->id) }}" class="berita-readmore-btn">
                        <span>Lihat Selengkapnya</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500">Tidak ada berita tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="pagination">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection
