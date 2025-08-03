@extends('layouts.app')

@section('styles')
<style>
    .recipe-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        border-radius: 20px 20px 0 0;
        margin-bottom: 0;
    }
    
    .recipe-image {
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        object-fit: cover;
        height: 400px;
        width: 100%;
    }
    
    .recipe-image:hover {
        transform: scale(1.02);
    }
    
    .recipe-card {
        border: none;
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        background: white;
    }
    
    .difficulty-badge {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .difficulty-easy { background: linear-gradient(45deg, #56ab2f, #a8e6cf); color: white; }
    .difficulty-medium { background: linear-gradient(45deg, #f7971e, #ffd200); color: white; }
    .difficulty-hard { background: linear-gradient(45deg, #ee0979, #ff6a00); color: white; }
    
    .info-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #667eea;
    }
    
    .info-icon {
        width: 24px;
        height: 24px;
        margin-right: 10px;
        color: #667eea;
    }
    
    .info-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .info-content {
        color: #6c757d;
        line-height: 1.6;
        margin-left: 34px;
    }
    
    .action-btn {
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
        margin: 0 8px 8px 0;
    }
    
    .btn-review {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
    }
    
    .btn-review:hover {
        background: linear-gradient(45deg, #ee5a52, #c44569);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(238, 90, 82, 0.3);
    }
    
    .btn-rating {
        background: linear-gradient(45deg, #4ecdc4, #44a08d);
        color: white;
    }
    
    .btn-rating:hover {
        background: linear-gradient(45deg, #44a08d, #093637);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(78, 205, 196, 0.3);
    }
    
    .favorite-btn {
        background: linear-gradient(45deg, #f093fb, #f5576c);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
    }
    
    .favorite-btn:hover {
        background: linear-gradient(45deg, #f5576c, #e91e63);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
    }
    
    .favorite-btn.active {
        background: linear-gradient(45deg, #56ab2f, #a8e6cf);
    }
    
    .owner-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 0 0 20px 20px;
        text-align: center;
    }
    
    .owner-btn {
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .owner-btn:hover {
        background: rgba(255,255,255,0.3);
        border-color: rgba(255,255,255,0.5);
        color: white;
        transform: translateY(-2px);
    }
    
    .recipe-stats {
        display: flex;
        justify-content: space-around;
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        margin: 2rem 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .stat-item {
        text-align: center;
        flex: 1;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #667eea;
        display: block;
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    @media (max-width: 768px) {
        .recipe-hero {
            padding: 2rem 0;
        }
        
        .recipe-image {
            height: 250px;
            margin-bottom: 2rem;
        }
        
        .recipe-stats {
            flex-direction: column;
            gap: 1rem;
        }
        
        .action-btn {
            width: 100%;
            margin: 8px 0;
        }
    }
</style>
@endsection

@section('content')
<div class="container my-4">
    <div class="recipe-card">
        <!-- Hero Section -->
        <div class="recipe-hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold mb-3">{{$recipe->name}}</h1>
                        <p class="lead mb-0">Discover the perfect blend of flavors in this amazing recipe</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <span class="difficulty-badge difficulty-{{$recipe->difficulty}}">
                            {{ucfirst($recipe->difficulty)}} Level
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="row">
                <!-- Recipe Image -->
                <div class="col-lg-6 mb-4">
                    <img src="{{asset('uploaded_img_recipes/'.$recipe->image_path)}}" 
                         alt="{{$recipe->name}}" 
                         class="recipe-image">
                    
                    <!-- Recipe Stats -->
                    <div class="recipe-stats">
                        <div class="stat-item">
                            <span class="stat-number">⏱️</span>
                            <span class="stat-label">Cooking Time</span>
                            <div class="fw-bold">{{$recipe->cooking_time}}</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">🍽️</span>
                            <span class="stat-label">Cuisine</span>
                            <div class="fw-bold">{{ucfirst($recipe->cuisine_type)}}</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">⭐</span>
                            <span class="stat-label">Difficulty</span>
                            <div class="fw-bold">{{ucfirst($recipe->difficulty)}}</div>
                        </div>
                    </div>
                </div>

                <!-- Recipe Details -->
                <div class="col-lg-6">
                    <!-- Ingredients Section -->
                    <div class="info-section">
                        <div class="info-title">
                            <svg class="info-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                            Ingredients
                        </div>
                        <div class="info-content">{{$recipe->ingredients}}</div>
                    </div>

                    <!-- Instructions Section -->
                    <div class="info-section">
                        <div class="info-title">
                            <svg class="info-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Instructions
                        </div>
                        <div class="info-content">{{$recipe->instructions}}</div>
                    </div>

                    @auth
                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap mb-3">
                            <a href="{{route('recipeReview',['id' => $recipe->id])}}" class="action-btn btn-review">
                                📝 Write Review
                            </a>
                            <a href="{{route('showRating',['id' => $recipe->id])}}" class="action-btn btn-rating">
                                ⭐ Rate Recipe
                            </a>
                        </div>

                        <!-- Favorite Button -->
                        <form action="{{ route('favorite' , ['id' => $recipe->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <button type="submit" class="favorite-btn {{ $recipe->isFavorite() ? 'active' : '' }}">
                                @if ($recipe->isFavorite())
                                    💔 Remove from Favorites
                                @else
                                    ❤️ Add to Favorites
                                @endif
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info rounded-3">
                            <h6 class="mb-2">🔐 Want to interact with this recipe?</h6>
                            <p class="mb-0">Please <a href="{{ route('login') }}" class="text-decoration-none fw-bold">login</a> to rate, review, and favorite this recipe!</p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Owner Section -->
        <div class="owner-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-2">👨‍🍳 Recipe Created By</h5>
                    <p class="mb-0 opacity-75">Discover more amazing recipes from this talented chef</p>
                </div>
                <div class="col-md-4">
                    <a href="{{route('ownerProfile' , ['id' => $recipe->user->id])}}" class="owner-btn">
                        View {{$recipe->user->name}}'s Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Recipes Button -->
<div class="container my-4">
    <div class="text-center">
        <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            ← Back to All Recipes
        </a>
    </div>
</div>
@endsection