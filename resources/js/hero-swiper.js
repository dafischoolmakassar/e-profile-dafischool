import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

const swiper = new Swiper('.hero-swiper', {
    modules: [Pagination, Autoplay],
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    grabCursor: true,
    on: {
        slideChange(swiper) {
            // Re-trigger caption animation on slide change
            const caption = swiper.slides[swiper.activeIndex].querySelector('.hero-caption');
            if (caption) {
                caption.style.animation = 'none';
                // Trigger reflow to restart animation
                void caption.offsetWidth;
                caption.style.animation = '';
            }
        },
    },
});

// Mobile: hide WA (hidden sm:inline-flex) → move dots to WA's former spot rata kanan
// CSS fallback in app.css may be overridden by swiper/css/pagination lazy chunk,
// so enforce via inline style with !important which wins over stylesheet.
const paginationEl = document.querySelector('.hero-swiper .swiper-pagination');

const positionPagination = () => {
    if (!paginationEl) return;
    if (window.innerWidth <= 639) {
        paginationEl.style.setProperty('text-align', 'right', 'important');
        paginationEl.style.setProperty('display', 'block', 'important');
        paginationEl.style.setProperty('padding-right', '16px', 'important');
        paginationEl.style.setProperty('padding-left', '40%', 'important');
        paginationEl.style.setProperty('bottom', '20px', 'important');
        paginationEl.style.setProperty('top', 'auto', 'important');
        paginationEl.style.setProperty('left', '0', 'important');
        paginationEl.style.setProperty('right', '0', 'important');
        paginationEl.style.setProperty('width', '100%', 'important');
    } else {
        paginationEl.style.removeProperty('text-align');
        paginationEl.style.removeProperty('display');
        paginationEl.style.removeProperty('padding-right');
        paginationEl.style.removeProperty('padding-left');
        paginationEl.style.removeProperty('bottom');
        paginationEl.style.removeProperty('top');
        paginationEl.style.removeProperty('left');
        paginationEl.style.removeProperty('right');
        paginationEl.style.removeProperty('width');
    }
};

positionPagination();
window.addEventListener('resize', positionPagination);
