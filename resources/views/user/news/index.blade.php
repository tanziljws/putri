<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset default styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        /* Base styles */
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f8fafc; 
            min-height: 100vh;
        }
        
        /* News container */
        .news-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 2rem 1rem;
        }
        
        /* News grid */
        .news-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            gap: 1.5rem; 
            padding: 1rem 0; 
        }
        
        /* News card */
        .news-card { 
            background: #fff; 
            border-radius: 8px; 
            overflow: hidden; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* News image */
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
        
        /* News content */
        .news-content { 
            padding: 1.25rem; 
        }
        
        .news-date { 
            display: block;
            font-size: 0.8rem; 
            color: #6b7280; 
            margin-bottom: 0.5rem; 
        }
        
        .news-title { 
            font-size: 1.1rem; 
            font-weight: 600; 
            color: #1f2937; 
            margin: 0 0 0.5rem; 
            line-height: 1.4; 
        }
        
        .news-excerpt { 
            font-size: 0.9rem; 
            color: #6b7280; 
            margin: 0; 
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Pagination */
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
        
        .pagination a, .pagination span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .pagination a:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }
        
        .pagination .active span {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) { 
            .news-grid { 
                grid-template-columns: 1fr; 
            }
            
            .news-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="news-container">
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
                        <span class="news-date">
                            {{ $item->published_date ? $item->published_date->format('d M Y') : $item->created_at->format('d M Y') }}
    overflow: hidden;
}

.news-excerpt {
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

.news-category {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.news-link {
    color: #4f7cff;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
}

.news-link:hover {
    color: #3b5fc5;
}

.news-link svg {
    transition: transform 0.3s ease;
}

.news-link:hover svg {
    transform: translateX(3px);
}

/* Responsive */
@media (max-width: 1024px) {
    .news-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .news-hero {
        padding: 3rem 0;
    }
    
    .news-hero h1 {
        font-size: 2rem;
    }
    
    .news-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .news-hero h1 {
        font-size: 1.75rem;
    }
    
    .news-hero p {
        font-size: 1rem;
    }
    
    .news-container {
        padding: 0 1.25rem;
    }
}
</style>

<div style="padding: 1rem 0;">

<!-- News Grid -->
<div class="news-container">
    <div class="news-grid">
        @forelse($news as $item)
            <div class="news-card">
                <div class="news-image">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                        </span>
                        <h3 class="news-title">{{ $item->title }}</h3>
                        <p class="news-excerpt">
                            {{ Str::limit(strip_tags($item->content), 120) }}
                        </p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 2rem 0;">
                    <p style="color: #6b7280;">Tidak ada berita tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
        {{ $news->links() }}
    </div>
</body>
</html>
