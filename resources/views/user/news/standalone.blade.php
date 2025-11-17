<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini</title>
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body { 
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
            padding: 0;
        }

        .news-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .news-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover .news-image img {
            transform: scale(1.05);
        }

        .news-content {
            padding: 1.25rem;
        }

        .news-date {
            display: block;
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .news-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem;
            line-height: 1.4;
        }

        .news-excerpt {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 0.25rem;
        }

        .pagination a, 
        .pagination span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background-color: #f1f5f9;
        }

        .pagination .active span {
            background-color: #1e40af;
            border-color: #1e40af;
            color: white;
        }

        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="news-grid">
            @forelse($news as $item)
                <article class="news-card">
                    <div class="news-image">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        @else
                            <img src="{{ asset('images/default-news.jpg') }}" alt="Default News Image">
                        @endif
                    </div>
                    <div class="news-content">
                        <time class="news-date" datetime="{{ $item->published_date ?? $item->created_at }}">
                            {{ $item->published_date ? $item->published_date->format('d M Y') : $item->created_at->format('d M Y') }}
                        </time>
                        <h2 class="news-title">{{ $item->title }}</h2>
                        <p class="news-excerpt">
                            {{ Str::limit(strip_tags($item->content), 150) }}
                        </p>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 0;">
                    <p style="color: #64748b; font-size: 1.1rem;">Tidak ada berita tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        @if($news->hasPages())
            <div class="pagination-wrapper">
                {{ $news->links() }}
            </div>
        @endif
    </div>
</body>
</html>
