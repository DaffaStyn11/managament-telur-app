    <script>
        feather.replace();

        // Update feather icons when Alpine re-renders
        document.addEventListener('alpine:initialized', () => {
            setTimeout(() => feather.replace(), 100);
        });

        // Chart Produksi Telur
        const ctx = document.getElementById('eggChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Produksi Telur',
                    data: [320, 340, 300, 380, 360, 390, 410],
                    borderWidth: 3,
                    borderColor: '#FBBF24',
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#FBBF24',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#374151',
                        borderWidth: 1,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Ringkasan Keuangan
        new Chart(document.getElementById('chartRingkasan'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [5000, 7000, 6000, 8000, 9500, 10000],
                    borderWidth: 2,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Saldo
        new Chart(document.getElementById('chartSaldo'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Saldo',
                    data: [2000, 2500, 3000, 3500, 4000, 5000],
                    backgroundColor: '#10b981',
                    borderRadius: 8,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Penjualan
        new Chart(document.getElementById('chartPenjualan'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penjualan',
                    data: [4000, 4500, 5000, 5500, 7000, 7500],
                    backgroundColor: '#8b5cf6',
                    borderRadius: 8,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Pengeluaran
        new Chart(document.getElementById('chartPengeluaran'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pengeluaran',
                    data: [1500, 1800, 1700, 2000, 2500, 3200],
                    borderWidth: 2,
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#f97316',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // --- GRAFIK PERBANDINGAN (BAR) ---
        const ctxComparation = document.getElementById('chartComparation').getContext('2d');
        new Chart(ctxComparation, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei"],
                datasets: [
                    {
                        label: "Pengeluaran",
                        data: [1200000, 1500000, 1300000, 1400000, 1600000],
                        backgroundColor: "rgba(239,68,68,0.8)",
                        borderColor: "#ef4444",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    },
                    {
                        label: "Penjualan",
                        data: [2400000, 2600000, 2500000, 3000000, 3500000],
                        backgroundColor: "rgba(16,185,129,0.8)",
                        borderColor: "#10b981",
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 14, family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 12, family: 'Inter' },
                            padding: 15,
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { drawBorder: false, color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { size: 11, family: 'Inter' },
                            callback: value => 'Rp ' + (value / 1000000) + 'jt'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, family: 'Inter' } }
                    }
                }
            }
        });
    </script>
