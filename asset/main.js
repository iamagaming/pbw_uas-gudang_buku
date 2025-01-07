// Loading Animation
document.addEventListener('DOMContentLoaded', function() {
    const loading = document.querySelector('.loading');
    if (loading) {
        setTimeout(() => {
            loading.style.opacity = '0';
            setTimeout(() => {
                loading.style.display = 'none';
            }, 500);
        }, 1500);
    }
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Animated Counter
function animateCounter(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        element.textContent = Math.floor(current);
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, 10);
}

// Product Card Hover Effect
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mousemove', function(e) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    });
});

// Dynamic Search Filter
const searchInput = document.querySelector('#search');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.product-card');
        
        products.forEach(product => {
            const title = product.querySelector('.card-title').textContent.toLowerCase();
            const author = product.querySelector('.card-author').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || author.includes(searchTerm)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    });
}

// Cart Animation
function addToCart(productId) {
    const cart = document.querySelector('.cart-icon');
    const product = document.querySelector(`#product-${productId}`);
    
    if (cart && product) {
        const productRect = product.getBoundingClientRect();
        const cartRect = cart.getBoundingClientRect();
        
        const clone = product.querySelector('img').cloneNode();
        clone.style.position = 'fixed';
        clone.style.top = `${productRect.top}px`;
        clone.style.left = `${productRect.left}px`;
        clone.style.width = `${productRect.width}px`;
        clone.style.height = `${productRect.height}px`;
        clone.style.transition = 'all 0.8s ease-in-out';
        clone.style.zIndex = '9999';
        
        document.body.appendChild(clone);
        
        setTimeout(() => {
            clone.style.top = `${cartRect.top}px`;
            clone.style.left = `${cartRect.left}px`;
            clone.style.width = '30px';
            clone.style.height = '30px';
            clone.style.opacity = '0';
        }, 0);
        
        setTimeout(() => {
            clone.remove();
            updateCartCount();
        }, 800);
    }
}

// Update cart count with animation
function updateCartCount() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        const currentCount = parseInt(cartCount.textContent);
        cartCount.textContent = currentCount + 1;
        cartCount.classList.add('bump');
        setTimeout(() => cartCount.classList.remove('bump'), 300);
    }
}

// Intersection Observer for fade-in animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.fade-in-section').forEach((element) => {
    observer.observe(element);
}); 