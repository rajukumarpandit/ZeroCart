/* ================================
   DASHBOARD CHARTS & WIDGETS
   ================================ */

// Chart Configuration
const chartColors = {
  primary: '#6366f1',
  success: '#22c55e',
  warning: '#f59e0b',
  danger: '#ef4444',
  info: '#3b82f6',
  secondary: '#64748b',
  light: getComputedStyle(document.documentElement).getPropertyValue('--border-light').trim(),
  text: getComputedStyle(document.documentElement).getPropertyValue('--text-primary').trim(),
  grid: getComputedStyle(document.documentElement).getPropertyValue('--border-color').trim()
};

// Update chart colors on theme change
function updateChartColors() {
  chartColors.light = getComputedStyle(document.documentElement).getPropertyValue('--border-light').trim();
  chartColors.text = getComputedStyle(document.documentElement).getPropertyValue('--text-primary').trim();
  chartColors.grid = getComputedStyle(document.documentElement).getPropertyValue('--border-color').trim();
}

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart');
if (revenueCtx) {
  const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label: 'Revenue',
          data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 38000, 42000, 45000],
          borderColor: chartColors.primary,
          backgroundColor: 'rgba(99, 102, 241, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointRadius: 0,
          pointHoverRadius: 6,
          pointHoverBackgroundColor: chartColors.primary,
          pointHoverBorderColor: '#ffffff',
          pointHoverBorderWidth: 2
        },
        {
          label: 'Expenses',
          data: [8000, 12000, 10000, 15000, 13000, 18000, 16000, 20000, 19000, 22000, 24000, 26000],
          borderColor: chartColors.danger,
          backgroundColor: 'rgba(239, 68, 68, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointRadius: 0,
          pointHoverRadius: 6,
          pointHoverBackgroundColor: chartColors.danger,
          pointHoverBorderColor: '#ffffff',
          pointHoverBorderWidth: 2
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      interaction: {
        intersect: false,
        mode: 'index'
      },
      plugins: {
        legend: {
          display: true,
          position: 'top',
          align: 'end',
          labels: {
            boxWidth: 12,
            boxHeight: 12,
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 20,
            color: chartColors.text,
            font: {
              size: 13,
              weight: '500'
            }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          padding: 12,
          titleColor: '#ffffff',
          titleFont: {
            size: 13,
            weight: '600'
          },
          bodyColor: '#ffffff',
          bodyFont: {
            size: 12
          },
          borderColor: 'rgba(255, 255, 255, 0.1)',
          borderWidth: 1,
          displayColors: true,
          usePointStyle: true,
          callbacks: {
            label: function(context) {
              let label = context.dataset.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                label += '$' + context.parsed.y.toLocaleString();
              }
              return label;
            }
          }
        }
      },
      scales: {
        x: {
          grid: {
            display: false,
            drawBorder: false
          },
          ticks: {
            color: chartColors.text,
            font: {
              size: 12
            }
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: chartColors.grid,
            drawBorder: false
          },
          ticks: {
            color: chartColors.text,
            font: {
              size: 12
            },
            callback: function(value) {
              return '$' + (value / 1000) + 'K';
            }
          }
        }
      }
    }
  });
  
  // Store chart instance for theme updates
  window.revenueChart = revenueChart;
}

// Category Chart (Doughnut)
const categoryCtx = document.getElementById('categoryChart');
if (categoryCtx) {
  const categoryChart = new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
      labels: ['Electronics', 'Clothing', 'Food', 'Books', 'Other'],
      datasets: [{
        data: [35, 25, 20, 12, 8],
        backgroundColor: [
          chartColors.primary,
          chartColors.success,
          chartColors.warning,
          chartColors.info,
          chartColors.secondary
        ],
        borderWidth: 0,
        hoverOffset: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
          labels: {
            boxWidth: 12,
            boxHeight: 12,
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 15,
            color: chartColors.text,
            font: {
              size: 12,
              weight: '500'
            }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          padding: 12,
          titleColor: '#ffffff',
          titleFont: {
            size: 13,
            weight: '600'
          },
          bodyColor: '#ffffff',
          bodyFont: {
            size: 12
          },
          borderColor: 'rgba(255, 255, 255, 0.1)',
          borderWidth: 1,
          displayColors: true,
          usePointStyle: true,
          callbacks: {
            label: function(context) {
              let label = context.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed !== null) {
                label += context.parsed + '%';
              }
              return label;
            }
          }
        }
      },
      cutout: '70%'
    }
  });
  
  // Store chart instance for theme updates
  window.categoryChart = categoryChart;
}

// Update charts when theme changes
const originalSetTheme = window.emoceAdmin?.setTheme;
if (originalSetTheme) {
  window.emoceAdmin.setTheme = function(theme) {
    originalSetTheme(theme);
    
    // Update chart colors
    updateChartColors();
    
    // Update revenue chart
    if (window.revenueChart) {
      window.revenueChart.options.plugins.legend.labels.color = chartColors.text;
      window.revenueChart.options.scales.x.ticks.color = chartColors.text;
      window.revenueChart.options.scales.y.ticks.color = chartColors.text;
      window.revenueChart.options.scales.y.grid.color = chartColors.grid;
      window.revenueChart.update();
    }
    
    // Update category chart
    if (window.categoryChart) {
      window.categoryChart.options.plugins.legend.labels.color = chartColors.text;
      window.categoryChart.update();
    }
  };
}

// Revenue Period Buttons
const revenuePeriodButtons = document.querySelectorAll('input[name="revenue-period"]');
revenuePeriodButtons.forEach(button => {
  button.addEventListener('change', function() {
    if (window.revenueChart) {
      let labels, revenueData, expensesData;
      
      if (this.id === 'revenue-week') {
        labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        revenueData = [5000, 6000, 5500, 7000, 6500, 8000, 7500];
        expensesData = [3000, 3500, 3200, 4000, 3800, 4500, 4200];
      } else if (this.id === 'revenue-month') {
        labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        revenueData = [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 38000, 42000, 45000];
        expensesData = [8000, 12000, 10000, 15000, 13000, 18000, 16000, 20000, 19000, 22000, 24000, 26000];
      } else if (this.id === 'revenue-year') {
        labels = ['2019', '2020', '2021', '2022', '2023', '2024'];
        revenueData = [120000, 180000, 220000, 280000, 350000, 420000];
        expensesData = [80000, 120000, 150000, 180000, 220000, 260000];
      }
      
      window.revenueChart.data.labels = labels;
      window.revenueChart.data.datasets[0].data = revenueData;
      window.revenueChart.data.datasets[1].data = expensesData;
      window.revenueChart.update();
    }
  });
});

// Animate statistics on scroll
function animateStats() {
  const stats = document.querySelectorAll('.stat-value');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = entry.target;
        const targetValue = target.textContent;
        
        // Check if value contains numbers
        if (/\d/.test(targetValue)) {
          target.style.opacity = '0';
          
          setTimeout(() => {
            target.style.transition = 'opacity 0.5s ease';
            target.style.opacity = '1';
          }, 100);
        }
        
        observer.unobserve(target);
      }
    });
  }, {
    threshold: 0.5
  });
  
  stats.forEach(stat => observer.observe(stat));
}

// Animate progress bars
function animateProgress() {
  const progressBars = document.querySelectorAll('.progress-bar');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const progressBar = entry.target;
        const targetWidth = progressBar.style.width;
        
        progressBar.style.width = '0';
        
        setTimeout(() => {
          progressBar.style.width = targetWidth;
        }, 100);
        
        observer.unobserve(progressBar);
      }
    });
  }, {
    threshold: 0.5
  });
  
  progressBars.forEach(bar => observer.observe(bar));
}

// Initialize animations
document.addEventListener('DOMContentLoaded', () => {
  animateStats();
  animateProgress();
});

// Real-time updates simulation (optional)
function simulateRealTimeUpdates() {
  setInterval(() => {
    // Update notification badge randomly
    const notifBadge = document.querySelector('.notification-badge');
    if (notifBadge && Math.random() > 0.7) {
      let count = parseInt(notifBadge.textContent);
      count = Math.min(count + 1, 99);
      notifBadge.textContent = count;
      notifBadge.style.display = '';
      
      // Show toast notification
      if (window.emoceAdmin?.showToast) {
        window.emoceAdmin.showToast('You have a new notification', 'info');
      }
    }
  }, 30000); // Every 30 seconds
}

// Uncomment to enable real-time updates simulation
// simulateRealTimeUpdates();
