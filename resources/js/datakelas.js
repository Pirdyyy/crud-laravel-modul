        // ======================= LIVE SEARCH FUNCTIONALITY =======================
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('liveSearch');
            const clearSearchBtn = document.getElementById('clearSearch');
            const clearSearchResultsBtn = document.getElementById('clearSearchResults');
            const resetSearchBtn = document.getElementById('resetSearchBtn');
            const tableBody = document.getElementById('tableBody');
            const searchInfo = document.getElementById('searchInfo');
            const searchResultsText = document.getElementById('searchResultsText');
            const filteredCount = document.getElementById('filteredCount');
            const noResults = document.getElementById('noResults');
            const rows = document.querySelectorAll('.data-row');

            // Fungsi untuk melakukan pencarian
            function performSearch(searchTerm) {
                const term = searchTerm.toLowerCase().trim();
                let visibleCount = 0;

                rows.forEach(row => {
                    const nama = row.getAttribute('data-nama');
                    const wali = row.getAttribute('data-wali');
                    const ketua = row.getAttribute('data-ketua');
                    const kursi = row.getAttribute('data-kursi');
                    const meja = row.getAttribute('data-meja');

                    // Cari di semua field
                    const match = nama.includes(term) ||
                        wali.includes(term) ||
                        ketua.includes(term) ||
                        kursi.includes(term) ||
                        meja.includes(term);

                    if (match || term === '') {
                        row.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                });

                // Update UI berdasarkan hasil pencarian
                updateSearchUI(visibleCount, term);
            }

            // Update UI setelah pencarian
            function updateSearchUI(visibleCount, term) {
                const totalRows = rows.length;

                // Update counter
                filteredCount.textContent = visibleCount;

                // Tampilkan/sembunyikan pesan "tidak ditemukan"
                if (term !== '' && visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    tableBody.parentElement.parentElement.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    tableBody.parentElement.parentElement.classList.remove('hidden');
                }

                // Tampilkan info pencarian
                if (term !== '') {
                    searchInfo.classList.remove('hidden');
                    searchResultsText.textContent =
                        `Menampilkan ${visibleCount} dari ${totalRows} hasil untuk "${term}"`;
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    searchInfo.classList.add('hidden');
                    clearSearchBtn.classList.add('hidden');
                }
            }

            // Event listener untuk input search
            searchInput.addEventListener('input', function() {
                performSearch(this.value);
            });

            // Event listener untuk clear search
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                performSearch('');
                searchInput.focus();
            });

            // Event listener untuk clear search results
            if (clearSearchResultsBtn) {
                clearSearchResultsBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    performSearch('');
                    searchInput.focus();
                });
            }

            // Event listener untuk reset search button
            if (resetSearchBtn) {
                resetSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    performSearch('');
                    searchInput.focus();
                });
            }

            // Debounce untuk search (optional, untuk performance)
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performSearch(this.value);
                }, 300); // Delay 300ms
            });
        });

        // ======================= BULK DELETE FUNCTIONALITY =======================
        document.addEventListener('DOMContentLoaded', function() {
            const mainCheckbox = document.getElementById('mainCheckbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const bulkControls = document.getElementById('bulkControls');
            const selectedItemsCount = document.getElementById('selectedItemsCount');
            const deleteSelectedBtn = document.getElementById('deleteSelected');
            const clearSelectionBtn = document.getElementById('clearSelection');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');
            const selectedIdsInput = document.getElementById('selectedIds');

            function updateSelectionUI() {
                const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
                const count = checkedBoxes.length;

                if (count > 0) {
                    bulkControls.classList.remove('hidden');
                    selectedItemsCount.textContent = `${count} item terpilih`;

                    mainCheckbox.checked = count === itemCheckboxes.length;
                    selectAllCheckbox.checked = count === itemCheckboxes.length;
                } else {
                    bulkControls.classList.add('hidden');
                }

                const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);
                selectedIdsInput.value = JSON.stringify(selectedIds);
            }

            mainCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                updateSelectionUI();
            });

            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                mainCheckbox.checked = isChecked;
                updateSelectionUI();
            });

            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectionUI);
            });

            clearSelectionBtn.addEventListener('click', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                mainCheckbox.checked = false;
                selectAllCheckbox.checked = false;
                updateSelectionUI();
            });

            deleteSelectedBtn.addEventListener('click', function() {
                const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    alert('Pilih setidaknya satu item untuk dihapus');
                    return;
                }

                const itemNames = Array.from(checkedBoxes).map(cb => {
                    const row = cb.closest('tr');
                    return row.querySelector('td:nth-child(3) .font-medium').textContent;
                });

                if (confirm(
                        `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} kelas berikut?\n\n${itemNames.join('\n')}`
                    )) {
                    bulkDeleteForm.submit();
                }
            });

            updateSelectionUI();
        });

        // ======================= DETAIL VIEW MODAL FUNCTIONS =======================
        function showDetailModal(id, nama, wali, ketua, kursi, meja, gambar) {
            // Set data ke modal
            document.getElementById('detailNama').textContent = nama || '-';
            document.getElementById('detailWali').textContent = wali || '-';
            document.getElementById('detailKetua').textContent = ketua || '-';
            document.getElementById('detailKursi').textContent = kursi || '0';
            document.getElementById('detailMeja').textContent = meja || '0';

            // Set link edit
            document.getElementById('editBtn').href = `/kelas/${id}/edit`;

            // Handle gambar
            const gambarContainer = document.getElementById('detailGambarContainer');
            const gambarElement = document.getElementById('detailGambar');
            const noImageMessage = document.getElementById('noImageMessage');

            if (gambar) {
                gambarElement.src = `{{ url('upload_gambar') }}/${gambar}`;
                gambarElement.classList.remove('hidden');
                noImageMessage.classList.add('hidden');
                gambarElement.onclick = () => openImageModal(`{{ url('upload_gambar') }}/${gambar}`, nama);
            } else {
                gambarElement.classList.add('hidden');
                noImageMessage.classList.remove('hidden');
            }

            // Tampilkan modal
            document.getElementById('detailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // ======================= IMAGE MODAL FUNCTIONS =======================
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title || 'Preview Gambar';
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // ======================= UTILITY FUNCTIONS =======================
        function confirmDelete(className) {
            return confirm(`Apakah Anda yakin ingin menghapus kelas "${className}"?`);
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
                closeDetailModal();
            }
        });

        // Close modal on background click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') {
                closeImageModal();
            }
        });

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target.id === 'detailModal') {
                closeDetailModal();
            }
        });
         setTimeout(() => {
                document.querySelector('.fixed.bottom-4').style.display = 'none';
            }, 5000);