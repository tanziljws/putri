<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            padding: 20px;
        }
        .news-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }
        .news-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .news-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
        }
        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .news-content {
            padding: 15px;
        }
        .news-date {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .news-title {
            font-size: 1.1rem;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .news-excerpt {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            list-style: none;
        }
        .pagination li { margin: 0 5px; }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            color: #4b5563;
            text-decoration: none;
        }
        .pagination .active span {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        @media (max-width: 768px) {
            .news-grid { grid-template-columns: 1fr; }
            body { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="news-grid">
        @forelse($news as $item)
            <div class="news-card">
                <div class="news-image">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                        <img src="{{ asset('images/default-news.jpg') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="news-content">
                    <div class="news-date">
                        {{ $item->published_date ? $item->published_date->format('d M Y') : $item->created_at->format('d M Y') }}
                    </div>
                    <h3 class="news-title">{{ $item->title }}</h3>
                    <p class="news-excerpt">
                        {{ Str::limit(strip_tags($item->content), 120) }}
                    </p>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                <p style="color: #6b7280;">Tidak ada berita tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    @if($news->hasPages())
        <div class="pagination">
            {{ $news->links() }}
        </div>
    @endif
</body>
</html>
