@extends('layouts.user.app')

@section('content')
<style>
    .galeri-hero {
        background: #ffffff;
        padding: 3rem 0;
        margin-bottom: 2.5rem;
        border-bottom: 3px solid #4f7cff;
    }

    .galeri-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .galeri-breadcrumb {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .galeri-breadcrumb a {
        color: #2563eb;
        text-decoration: none;
    }

    .galeri-breadcrumb a:hover {
        text-decoration: underline;
    }

    .galeri-hero-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .galeri-hero-subtitle {
        font-size: 1rem;
        color: #6b7280;
        max-width: 540px;
    }

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.75rem;
        margin-bottom: 2rem;
    }

    .galeri-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 12px rgba(15, 23, 42, 0.12);
        cursor: pointer;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .galeri-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.18);
    }

    .galeri-image-wrapper {
        position: relative;
        width: 100%;
        height: 190px;
        overflow: hidden;
    }

    .galeri-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.25s ease;
        display: block;
    }

    .galeri-card:hover .galeri-image-wrapper img {
        transform: scale(1.05);
    }

    .galeri-category-badge {
        position: absolute;
        left: 0.75rem;
        top: 0.75rem;
        background: rgba(15, 23, 42, 0.8);
        color: #e5e7eb;
        padding: 0.25rem 0.6rem;
        border-radius: 999px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .galeri-card-body {
        padding: 1rem 1.1rem 1.1rem;
    }

    .galeri-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.4rem;
    }

    .galeri-card-desc {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .galeri-card-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .galeri-empty {
        text-align: center;
        padding: 3rem 0;
        color: #6b7280;
    }

    .galeri-pagination {
        display: flex;
        justify-content: center;
        margin: 2rem 0 1rem;
    }

    /* Modal */
    .galeri-modal-img {
        max-height: 70vh;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .galeri-container {
            padding: 0 1rem;
        }

        .galeri-hero-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="galeri-hero">
    <div class="galeri-container">
        <nav class="galeri-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('user.dashboard') }}">Beranda</a>
            <span> / </span>
            <span>Galeri</span>
        </nav>
        <h1 class="galeri-hero-title">
            <i class="fas fa-images"></i>
            <span>Galeri Sekolah</span>
        </h1>
        <p class="galeri-hero-subtitle">Kumpulan dokumentasi kegiatan, fasilitas, dan momen terbaik di lingkungan sekolah.</p>
    </div>
</div>

<div class="galeri-container">
    <div class="galeri-grid">
        @forelse($galleries as $gallery)
            <div class="galeri-card" data-bs-toggle="modal" data-bs-target="#galeriModal" data-image="{{ $gallery->cover_image ? asset('storage/'.$gallery->cover_image) : asset('images/default.jpg') }}" data-title="{{ $gallery->title }}" data-description="{{ $gallery->description }}">
                <div class="galeri-image-wrapper">
                    @if($gallery->cover_image)
                        <img src="{{ asset('storage/'.$gallery->cover_image) }}" alt="{{ $gallery->title }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" alt="{{ $gallery->title }}">
                    @endif
                    <span class="galeri-category-badge">{{ $gallery->category->name ?? 'Umum' }}</span>
                </div>
                <div class="galeri-card-body">
                    <div class="galeri-card-title">{{ $gallery->title }}</div>
                    <div class="galeri-card-desc">{{ Str::limit($gallery->description, 120, '...') }}</div>
                    <div class="galeri-card-meta">
                        <span>Dibuat: {{ $gallery->created_at?->format('d M Y') }}</span>
                        <span>Update: {{ $gallery->updated_at?->format('d M Y') }}</span>
                    </div>
                    <div style="margin-top:0.75rem; text-align:right;">
                        <a href="{{ route('user.gallery.show', $gallery->id) }}" class="btn btn-sm" style="background:#2563eb; color:white; border-radius:999px; padding:0.35rem 0.9rem; font-size:0.8rem; font-weight:500; text-decoration:none;">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="galeri-empty">Belum ada galeri tersedia.</div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div class="galeri-pagination">
            {{ $galleries->links() }}
        </div>
    @endif
</div>

<!-- Modal Lightbox -->
<div class="modal fade" id="galeriModal" tabindex="-1" aria-labelledby="galeriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background:#0b1120; color:#e5e7eb;">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="galeriModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="galeriModalImg" src="" alt="" class="img-fluid galeri-modal-img mb-3">
                <p id="galeriModalDesc" style="font-size:0.9rem; color:#cbd5f5;"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('galeriModal');
        const modalImg = document.getElementById('galeriModalImg');
        const modalTitle = document.getElementById('galeriModalLabel');
        const modalDesc = document.getElementById('galeriModalDesc');

        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const card = event.relatedTarget;
                if (!card) return;

                const image = card.getAttribute('data-image');
                const title = card.getAttribute('data-title');
                const description = card.getAttribute('data-description') || '';

                modalImg.src = image;
                modalTitle.textContent = title;
                modalDesc.textContent = description;
            });
        }
    });
</script>
@endsection
