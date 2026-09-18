/**
 * Results Live Search & Multi-Filter Logic
 * Enables instant filtering by stream, exam, campus, year, and roll number search.
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('result-search-input');
  const streamFilter = document.getElementById('filter-stream');
  const examFilter = document.getElementById('filter-exam');
  const campusFilter = document.getElementById('filter-campus');
  const yearFilter = document.getElementById('filter-year');
  const clearBtn = document.getElementById('clear-filters-btn');
  const resultCards = document.querySelectorAll('.result-card');
  const resultsGrid = document.getElementById('results-grid');
  const emptyState = document.getElementById('results-empty-state');
  const matchCount = document.getElementById('results-count-text');

  if (!resultCards.length) return;

  function filterResults() {
    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    const stream = streamFilter ? streamFilter.value : 'all';
    const exam = examFilter ? examFilter.value : 'all';
    const campus = campusFilter ? campusFilter.value : 'all';
    const year = yearFilter ? yearFilter.value : 'all';

    let visibleCount = 0;

    resultCards.forEach((card) => {
      const cardName = (card.dataset.name || '').toLowerCase();
      const cardRoll = (card.dataset.roll || '').toLowerCase();
      const cardStream = card.dataset.stream || '';
      const cardExam = card.dataset.exam || '';
      const cardCampus = card.dataset.campus || '';
      const cardYear = card.dataset.year || '';

      const matchesQuery = !query || cardName.includes(query) || cardRoll.includes(query);
      const matchesStream = stream === 'all' || cardStream.toLowerCase() === stream.toLowerCase();
      const matchesExam = exam === 'all' || cardExam.toLowerCase() === exam.toLowerCase();
      const matchesCampus = campus === 'all' || cardCampus.toLowerCase() === campus.toLowerCase();
      const matchesYear = year === 'all' || cardYear === year;

      if (matchesQuery && matchesStream && matchesExam && matchesCampus && matchesYear) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (emptyState) {
      if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
      } else {
        emptyState.classList.add('hidden');
      }
    }

    if (matchCount) {
      matchCount.textContent = `Showing ${visibleCount} result${visibleCount === 1 ? '' : 's'}`;
    }
  }

  if (searchInput) searchInput.addEventListener('input', filterResults);
  if (streamFilter) streamFilter.addEventListener('change', filterResults);
  if (examFilter) examFilter.addEventListener('change', filterResults);
  if (campusFilter) campusFilter.addEventListener('change', filterResults);
  if (yearFilter) yearFilter.addEventListener('change', filterResults);

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      if (searchInput) searchInput.value = '';
      if (streamFilter) streamFilter.value = 'all';
      if (examFilter) examFilter.value = 'all';
      if (campusFilter) campusFilter.value = 'all';
      if (yearFilter) yearFilter.value = 'all';
      filterResults();
    });
  }

  // Initial filter run
  filterResults();
});
