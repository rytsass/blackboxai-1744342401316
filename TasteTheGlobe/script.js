// Make performSearch globally accessible
window.performSearch = function() {
    console.log('Performing search...');
    const searchInput = document.getElementById('search-input');
    
    if (!searchInput) {
        console.error('Search input element not found');
        return;
    }

    const searchTerm = searchInput.value.trim();
    console.log('Search term:', searchTerm);
    
    if (!window.recipes) {
        console.error('Recipes not loaded yet');
        return;
    }

    if (!searchTerm) {
        console.log('Search term is empty');
        return;
    }

    console.log('Searching through', window.recipes.length, 'recipes');
    const results = searchRecipes(searchTerm);
    console.log('Found', results.length, 'results');
    displaySearchResults(results);
};

// Initialize search functionality
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM Content Loaded');
    
    // Get search elements
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    console.log('Search elements found:', {
        form: searchForm ? 'found' : 'not found',
        input: searchInput ? 'found' : 'not found',
        button: searchButton ? 'found' : 'not found'
    });

    // Load recipes immediately when the page loads
    fetch('recipes.json')
        .then(response => {
            console.log('Fetching recipes...');
            return response.json();
        })
        .then(data => {
            window.recipes = data;
            console.log('Recipes loaded successfully:', window.recipes.length, 'recipes');
            console.log('Available recipes:', window.recipes.map(r => r.name).join(', '));
        })
        .catch(error => {
            console.error('Error loading recipes:', error);
            window.recipes = [];
        });

    // Set up search functionality
    if (searchForm) {
        console.log('Setting up search form submit handler');
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Search form submitted');
            performSearch();
        });
    }

    if (searchInput) {
        console.log('Setting up search input handlers');
        searchInput.addEventListener('keydown', (e) => {
            console.log('Key pressed in search:', e.key);
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Enter key pressed in search');
                performSearch();
            }
        });

        searchInput.addEventListener('input', (e) => {
            console.log('Search input changed:', e.target.value);
        });
    }

    // Initialize form handling
    handleFormSubmission('recommendation-form', 'Thank you! You will receive recipe recommendations soon.');
    handleFormSubmission('signup-form', 'Account created successfully!');

    // Modal functionality
    const signUpButton = document.getElementById('sign-up-button');
    const modal = document.getElementById('signup-modal');
    const closeModal = document.getElementById('close-modal');

    if (signUpButton && modal && closeModal) {
        signUpButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

    // Remove preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
});

// Search recipes function
function searchRecipes(searchTerm) {
    searchTerm = searchTerm.toLowerCase();
    console.log('Searching recipes for term:', searchTerm);
    
    const results = window.recipes.filter(recipe => {
        const nameMatch = recipe.name.toLowerCase().includes(searchTerm);
        const descMatch = recipe.description.toLowerCase().includes(searchTerm);
        const tagMatch = (recipe.categoryTags || []).some(tag => tag.toLowerCase().includes(searchTerm));
        const ingredientMatch = (recipe.ingredients || []).some(ingredient => 
            typeof ingredient === 'string' && 
            ingredient.toLowerCase().includes(searchTerm)
        );

        const isMatch = nameMatch || descMatch || tagMatch || ingredientMatch;
        if (isMatch) {
            console.log('Match found:', recipe.name);
        }
        return isMatch;
    });

    console.log(`Found ${results.length} matching recipes`);
    return results;
}

// Display search results with recipe previews only
function displaySearchResults(results) {
    console.log('Displaying search results:', results.length);
    
    const existingModal = document.querySelector('.search-results-modal');
    if (existingModal) {
        document.body.removeChild(existingModal);
        console.log('Removed existing search results modal');
    }

    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-start justify-center search-results-modal overflow-y-auto pt-24 pb-8';
    
    const content = document.createElement('div');
    content.className = 'bg-white rounded-2xl p-8 max-w-6xl w-full mx-4 relative';
    
    let html = '<div class="flex justify-between items-center mb-6 sticky top-0 bg-white pb-4 border-b">';
    html += `<h2 class="text-2xl font-bold text-primary">Search Results (${results.length} found)</h2>`;
    html += '<button class="text-gray-500 hover:text-gray-700 close-search"><i class="fas fa-times"></i></button>';
    html += '</div>';

    if (results.length === 0) {
        html += '<p class="text-gray-600 text-center py-8">No recipes found. Try different keywords.</p>';
    } else {
        html += '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">';
        results.forEach(recipe => {
            const imageUrl = Array.isArray(recipe.imageUrl) ? recipe.imageUrl[0] : recipe.imageUrl;
            const categoryTags = recipe.categoryTags || [];

            html += `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-shadow duration-300">
                    <div class="relative overflow-hidden">
                        <img src="${imageUrl}" alt="${recipe.name}" 
                             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white">${recipe.name}</h3>
                                <p class="text-white/80 mt-2 line-clamp-2">${recipe.description}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <span><i class="far fa-clock mr-1"></i> ${recipe.prepTime}</span>
                            <span><i class="fas fa-users mr-1"></i> ${recipe.servings} servings</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-6">
                            ${categoryTags.map(tag => `
                                <span class="bg-accent/20 text-primary px-2 py-1 rounded-full text-sm">
                                    ${tag}
                                </span>
                            `).join('')}
                        </div>
                        <a href="recipe${window.recipes.indexOf(recipe) + 1}.html" 
                           class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary/80 transition-colors">
                            View Full Recipe
                        </a>
                    </div>
                </div>
            `;
        });
        html += '</div>';
    }

    content.innerHTML = html;
    modal.appendChild(content);
    document.body.appendChild(modal);
    console.log('Search results modal added to DOM');

    // Close button functionality
    const closeButton = modal.querySelector('.close-search');
    closeButton.addEventListener('click', () => {
        document.body.removeChild(modal);
        console.log('Search results modal closed');
    });

    // Close on outside click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            document.body.removeChild(modal);
            console.log('Search results modal closed (outside click)');
        }
    });

    // Add escape key listener
    document.addEventListener('keydown', function closeOnEscape(e) {
        if (e.key === 'Escape' && document.querySelector('.search-results-modal')) {
            document.body.removeChild(modal);
            document.removeEventListener('keydown', closeOnEscape);
            console.log('Search results modal closed (Escape key)');
        }
    });
}

// Form handling
function handleFormSubmission(formId, successMessage) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            submitButton.disabled = true;

            try {
                await new Promise(resolve => setTimeout(resolve, 1500));
                
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg';
                toast.textContent = successMessage;
                document.body.appendChild(toast);

                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 3000);

                form.reset();
            } catch (error) {
                console.error('Form submission error:', error);
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg';
                toast.textContent = 'An error occurred. Please try again.';
                document.body.appendChild(toast);

                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 3000);
            } finally {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }
        });
    }
}
