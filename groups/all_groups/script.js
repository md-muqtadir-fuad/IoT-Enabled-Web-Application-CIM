
  let chart = null;
  const threshold = 100; // Matches PHP threshold

  async function loadSensors() {
    try {
      const response = await fetch('show_data.php?mode=names&group=groupB8');
      if (!response.ok) throw new Error('Network response was not ok');
      const sensors = await response.json();

      let dropdown = document.getElementById('sensor_name');
      dropdown.innerHTML = "";

      if (sensors.length === 0) {
        dropdown.innerHTML = '<option value="">No sensors found</option>';
        return;
      }

      sensors.forEach(sensor => {
        let opt = document.createElement('option');
        opt.value = sensor;
        opt.textContent = sensor;
        dropdown.appendChild(opt);
      });

      dropdown.value = sensors[0];
      loadGraph();
    } catch (error) {
      console.error('Error loading sensors:', error);
      alert('Failed to load sensor list.');
    }
  }

  async function loadGraph() {
    const sensorName = document.getElementById('sensor_name').value;
    if (!sensorName) return;

    try {
      const response = await fetch(`show_data.php?mode=data&group=groupB8&sensor_name=${encodeURIComponent(sensorName)}`);
      if (!response.ok) throw new Error('Network response was not ok');
      const data = await response.json();

      if (data.error) {
        alert(data.error);
        return;
      }

      // Ensure only the latest 50 data points are used
      const timestamps = data.timestamps.slice(-50);
      const values = data.values.slice(-50);

      // Split data into below and above threshold
      const belowThresholdData = [];
      const aboveThresholdData = [];
      values.forEach((value, index) => {
        if (value <= threshold) {
          belowThresholdData[index] = value;
          aboveThresholdData[index] = null;
        } else {
          belowThresholdData[index] = null;
          aboveThresholdData[index] = value;
        }
      });

      const ctx = document.getElementById('myChart').getContext('2d');
      if (chart) chart.destroy();

      chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: timestamps,
          datasets: [
            {
              label: `${sensorName} Data (≤ Threshold)`,
              data: belowThresholdData,
              borderColor: '#8B0000',
              backgroundColor: 'rgba(139, 0, 0, 0.3)',
              fill: true,
              tension: 0.4,
              pointBackgroundColor: '#fff',
              pointBorderColor: '#8B0000',
              pointRadius: 5,
              pointHoverRadius: 8
            },
            {
              label: `${sensorName} Data (> Threshold)`,
              data: aboveThresholdData,
              borderColor: '#FF0000',
              backgroundColor: 'rgba(255, 0, 0, 0.3)',
              fill: true,
              tension: 0.4,
              pointBackgroundColor: '#fff',
              pointBorderColor: '#FF0000',
              pointRadius: 5,
              pointHoverRadius: 8
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            x: { title: { display: true, text: 'Timestamp', color: '#333' }, ticks: { color: '#333' }},
            y: { title: { display: true, text: 'Sensor Data', color: '#333' }, ticks: { color: '#333' }, beginAtZero: true }
          },
          plugins: {
            legend: { labels: { color: '#333' } },
            annotation: {
              annotations: {
                thresholdLine: {
                  type: 'line',
                  yMin: threshold,
                  yMax: threshold,
                  borderColor: '#A52A2A',
                  borderWidth: 2,
                  borderDash: [5, 5],
                  label: {
                    content: `Threshold: ${threshold}`,
                    enabled: true,
                    position: 'end',
                    backgroundColor: 'rgba(139, 0, 0, 0.7)',
                    color: '#fff',
                    yAdjust: -10
                  }
                }
              }
            }
          }
        }
      });
    } catch (error) {
      console.error('Error loading graph data:', error);
      alert('Failed to load sensor data.');
    }
  }

  loadSensors();

  const h1 = document.getElementById("crackText");
  if (h1) {
    const spans = h1.querySelectorAll("span");
    spans.forEach(span => {
      span.style.setProperty('--rand-x', Math.random());
      span.style.setProperty('--rand-y', Math.random());
      span.style.setProperty('--rand-r', Math.random());
    });

    h1.addEventListener("click", () => {
      h1.classList.add("cracked");
      setTimeout(() => {
        h1.classList.remove("cracked");
      }, 1500);
    });
  }

  const particleContainer = document.getElementById('particleContainer');
  function createParticle() {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.width = `${Math.random() * 10 + 5}px`;
    particle.style.height = particle.style.width;
    particle.style.left = `${Math.random() * 100}vw`;
    particle.style.animationDuration = `${Math.random() * 5 + 5}s`;
    particleContainer.appendChild(particle);
    setTimeout(() => particle.remove(), 10000);
  }

  setInterval(createParticle, 300);
