<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>AQI Map — Summary Card (Average of visible stations)</title>

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <style>
    :root{
      --aqi-good:#00E400; --aqi-moderate:#FFFF00; --aqi-usg:#FF7E00;
      --aqi-unhealthy:#FF0000; --aqi-very:#8F3F97; --aqi-hazard:#7E0023;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;background:#f3f6f9;color:#111}
    .header{padding:12px; display:flex; gap:12px; align-items:center; background:#fff; box-shadow:0 6px 24px rgba(10,20,30,.06)}
    .left{flex:1}
    label{font-weight:700;display:block;margin-bottom:6px}
    select{padding:8px 10px;border-radius:8px;border:1px solid #ddd;min-width:260px}
    .muted{color:#666;font-size:13px}
    .summary-card{
      width:100%;
      background:linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.85));
      border-radius:10px;
      box-shadow:0 8px 30px rgba(10,20,30,.06);
      padding:12px;
      display:flex;
      gap:12px;
      align-items:center;
    }
    .aqi-big{
      min-width:120px;
      min-height:90px;
      border-radius:10px;
      padding:12px;
      color:#fff;
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:center;
      font-weight:800;
      text-align:center;
    }
    .aqi-meta{font-size:13px;color:#333}
    .param-grid{display:grid; grid-template-columns: repeat(4, 1fr); gap:8px; margin-left:8px;}
    .param{background:#fff;border-radius:8px;padding:8px; text-align:center; font-size:13px; box-shadow:0 3px 10px rgba(10,20,30,.04)}
    .param b{display:block;font-weight:700}
    .container{max-width:1100px;margin:18px auto;padding:0 12px}
    #map{width:100%;height:68vh;border-radius:10px;margin-top:12px; overflow:hidden}
    .station-popup{font-size:13px}
    .station-popup b{display:block;margin-bottom:6px}
    @media(max-width:800px){
      .param-grid{grid-template-columns:repeat(2,1fr)}
      .aqi-big{min-width:100px}
      .summary-card{flex-direction:column;align-items:flex-start}
    }
  </style>
</head>
<body>

  <div class="header">
    <div class="left container">
      <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:center">
        <div>
          <label for="citySelect">Select City (curated)</label>
          <select id="citySelect">
            <option value="">-- choose city --</option>
          </select>
          <div class="muted">Auto-detect location on load (fallback: Jakarta).</div>
        </div>

        <div style="flex:1;">
          <label>Area Summary</label>
          <div class="summary-card" id="summaryCard">
            <div id="aqiBox" class="aqi-big" style="background:var(--aqi-moderate); color:#000;">
              <div style="font-size:22px" id="avgAQI">—</div>
              <div style="font-size:13px" id="avgCategory">—</div>
            </div>

            <div style="flex:1;">
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="aqi-meta" id="areaLabel">Area: —</div>
                <div class="muted" id="areaInfo">Stations: 0 • Averaged from up to 30 stations</div>
              </div>
              <div class="param-grid" id="paramGrid">
                <div class="param"><b>PM2.5</b><span id="avg_pm25">—</span></div>
                <div class="param"><b>PM10</b><span id="avg_pm10">—</span></div>
                <div class="param"><b>O₃</b><span id="avg_o3">—</span></div>
                <div class="param"><b>NO₂</b><span id="avg_no2">—</span></div>
                <div class="param"><b>SO₂</b><span id="avg_so2">—</span></div>
                <div class="param"><b>CO</b><span id="avg_co">—</span></div>
                <div class="param"><b>P (hPa)</b><span id="avg_p">—</span></div>
                <div class="param"><b>Avg Dist (km)</b><span id="avg_dist">—</span></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div id="map"></div>
  </div>

  <!-- libs -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script>
  /***** CONFIG *****/
  const WAQI_TOKEN = "43560c647d82b9daf429da457f7b39cbda4c3e41";
  const FALLBACK_CITY = { city: "Jakarta", country: "Indonesia", lat:-6.21462, lng:106.84513 };
  const MAX_DETAIL_STATIONS = 30; // max number of station detail fetches for averaging per refresh

  // curated city list for quick dropdown
  const curatedCities = [
  { country: "Indonesia", city: "Jakarta", lat: -6.21462, lng: 106.84513 },
    { country: "Indonesia", city: "Surabaya", lat: -7.24917, lng: 112.75083 },
    { country: "Indonesia", city: "Bandung", lat: -6.91746, lng: 107.61912 },
    { country: "Indonesia", city: "Medan", lat: 3.59520, lng: 98.67223 },
    { country: "Indonesia", city: "Semarang", lat: -6.96667, lng: 110.41667 },
    { country: "Indonesia", city: "Makassar", lat: -5.14767, lng: 119.43273 },
    { country: "Indonesia", city: "Denpasar", lat: -8.65000, lng: 115.21667 },
    { country: "Indonesia", city: "Yogyakarta", lat: -7.79722, lng: 110.36880 },
    { country: "Indonesia", city: "Palembang", lat: -2.99093, lng: 104.75656 },
    { country: "Indonesia", city: "Balikpapan", lat: -1.26753, lng: 116.82887 },
    { country: "Indonesia", city: "Pekanbaru", lat: 0.53333, lng: 101.45000 },
    { country: "Indonesia", city: "Batam", lat: 1.04563, lng: 104.03045 },
    { country: "United States", city: "New York", lat:40.71427, lng:-74.00597 },
    { country: "United States", city: "Los Angeles", lat:34.05223, lng:-118.24368 },
    { country: "United Kingdom", city: "London", lat:51.50722, lng:-0.1275 },
    { country: "France", city: "Paris", lat:48.85661, lng:2.35149 },
    { country: "China", city: "Beijing", lat:39.9042, lng:116.4074 },
    { country: "China", city: "Shanghai", lat:31.2304, lng:121.4737 },
    { country: "Japan", city: "Tokyo", lat:35.6895, lng:139.69171 },
    { country: "India", city: "Delhi", lat:28.65381, lng:77.2295 },
    { country: "India", city: "Mumbai", lat:19.07599, lng:72.87766 },
    { country: "Brazil", city: "São Paulo", lat:-23.5475, lng:-46.63611 },
    { country: "Australia", city: "Sydney", lat:-33.86785, lng:151.20732 },
    { country: "Russia", city: "Moscow", lat:55.75222, lng:37.61556 },
    { country: "Canada", city: "Toronto", lat:43.70011, lng:-79.4163 },
    { country: "South Korea", city: "Seoul", lat:37.566, lng:126.9784 },
    { country: "Germany", city: "Berlin", lat:52.52437, lng:13.41053 },
    { country: "Mexico", city: "Mexico City", lat:19.42847, lng:-99.12766 },
    { country: "Turkey", city: "Istanbul", lat:41.01384, lng:28.94966 },
    { country: "Egypt", city: "Cairo", lat:30.06263, lng:31.24967 }
  ];

  /***** UTILITIES *****/
  function getCssVar(name){ const v = getComputedStyle(document.documentElement).getPropertyValue(name); return v?v.trim():'#999'; }
  function aqiCategory(aqi){
    if (aqi == null || isNaN(Number(aqi))) return { cat: 'Unknown', color: '#999' };
    aqi = Number(aqi);
    if (aqi <= 50) return { cat: 'Good', color: getCssVar('--aqi-good') };
    if (aqi <= 100) return { cat: 'Moderate', color: getCssVar('--aqi-moderate') };
    if (aqi <= 150) return { cat: 'Unhealthy for Sensitive Groups', color: getCssVar('--aqi-usg') };
    if (aqi <= 200) return { cat: 'Unhealthy', color: getCssVar('--aqi-unhealthy') };
    if (aqi <= 300) return { cat: 'Very Unhealthy', color: getCssVar('--aqi-very') };
    return { cat: 'Hazardous', color: getCssVar('--aqi-hazard') };
  }
  function toFixedOrDash(v, digits=1){ return (v === null || v === undefined || isNaN(Number(v))) ? '—' : Number(v).toFixed(digits); }

  // Haversine
  function distanceKm(lat1,lon1,lat2,lon2){
    function r(d){return d*Math.PI/180}
    const R=6371; const dLat=r(lat2-lat1), dLon=r(lon2-lon1);
    const a=Math.sin(dLat/2)**2 + Math.cos(r(lat1))*Math.cos(r(lat2))*Math.sin(dLon/2)**2;
    return 2*R*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  }

  // concurrency-limited executor for promises (batching)
  async function batchFetch(urls, batchSize=6){
    const results = [];
    for(let i=0;i<urls.length;i+=batchSize){
      const batch = urls.slice(i,i+batchSize).map(u=>fetch(u).then(r=>r.json()).catch(e=>({error:e})));
      const res = await Promise.all(batch);
      results.push(...res);
    }
    return results;
  }

  /***** MAP & STATE *****/
  let map, stationMarkers = {}, lastStations = []; // lastStations from map/bounds (raw summary)
  function initMap(){
    map = L.map('map',{zoomControl:true}).setView([0,0],2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19, attribution:'&copy; OpenStreetMap contributors'}).addTo(map);

    map.on('moveend', debounce(async ()=>{
      const b = map.getBounds();
      const boundsStr = `${b.getNorth()},${b.getWest()},${b.getSouth()},${b.getEast()}`;
      await refreshStationsAndSummary(boundsStr);
    }, 700));
  }

  /***** UI populate curated dropdown *****/
  function populateDropdown(){
    const sel = document.getElementById('citySelect');
    curatedCities.forEach(c=>{
      const opt = document.createElement('option');
      opt.value = JSON.stringify(c);
      opt.textContent = `${c.city}, ${c.country}`;
      sel.appendChild(opt);
    });
    sel.addEventListener('change', e=>{
      if(!e.target.value) return;
      const obj = JSON.parse(e.target.value);
      selectCity(obj);
    });
  }

  /***** Fetch stations (map/bounds) and render markers *****/
  async function fetchStations(boundsStr){
    try{
      const url = `https://api.waqi.info/v2/map/bounds/?latlng=${boundsStr}&token=${WAQI_TOKEN}`;
      const r = await fetch(url);
      const j = await r.json();
      if(j.status !== 'ok') return [];
      return j.data || [];
    }catch(e){
      console.error('fetchStations err', e); return [];
    }
  }

  function clearMarkers(){
    for(const k in stationMarkers){ try{ map.removeLayer(stationMarkers[k]); }catch(e){} }
    stationMarkers = {};
  }

  function renderStationMarkers(stations){
    clearMarkers();
    stations.forEach(s=>{
      // sanitized aqi for icon path (if missing, use "na")
      const aqiVal = (s.aqi === undefined || s.aqi === null || s.aqi === '-') ? 'na' : s.aqi;
      const iconUrl = `https://waqi.info/mapicon/${aqiVal}.30.png`;
      const icon = L.icon({ iconUrl, iconSize:[46,46], iconAnchor:[23,23] });
      const marker = L.marker([s.lat, s.lon], { icon, title: s.station && s.station.name ? s.station.name : 'station' }).addTo(map);
      marker.on('click', async ()=>{
        const popup = L.popup({maxWidth:380}).setLatLng([s.lat,s.lon]).setContent(`<div class="station-popup"><b>${s.station && s.station.name ? s.station.name : 'Station'}</b>Loading details... (AQI ${s.aqi})</div>`).openOn(map);
        try{
          const detail = await fetchAQIDetail(s.uid);
          popup.setContent(buildPopupHtml(detail));
        }catch(err){
          popup.setContent(`<div class="station-popup"><b>${s.station && s.station.name ? s.station.name : 'Station'}</b><div>Error loading details</div></div>`);
        }
      });
      stationMarkers[s.uid] = marker;
    });
  }

  function buildPopupHtml(detail){
    const title = (detail.city && detail.city.name) ? detail.city.name : (detail.attributions && detail.attributions[0] && detail.attributions[0].name ? detail.attributions[0].name : 'Station');
    const aqi = detail.aqi !== undefined ? detail.aqi : '—';
    const timeStr = detail.time && (detail.time.s || detail.time.v) ? (detail.time.s || new Date(detail.time.v*1000).toLocaleString()) : '';
    let pollutantsHtml = '';
    if(detail.iaqi){
      const keys = Object.keys(detail.iaqi);
      pollutantsHtml = keys.map(k=>`<b>${k.toUpperCase()}</b>: ${detail.iaqi[k].v}`).join(' • ');
    }
    const sources = (detail.attributions || []).map(a => a.url ? `<a href="${a.url}" target="_blank" rel="noopener">${a.name}</a>` : a.name).join(' • ');
    return `<div class="station-popup"><b>${title}</b>
      <div><strong>AQI:</strong> ${aqi}</div>
      <div style="margin-top:6px">${pollutantsHtml || 'No pollutant data'}</div>
      <div class="muted" style="margin-top:8px;font-size:12px">${timeStr}</div>
      <div class="muted" style="margin-top:6px;font-size:12px">Sources: ${sources || '—'}</div>
    </div>`;
  }

  async function fetchAQIDetail(uid){
    const url = `https://api.waqi.info/feed/@${uid}/?token=${WAQI_TOKEN}`;
    const r = await fetch(url);
    const j = await r.json();
    if(j.status !== 'ok') throw j;
    return j.data;
  }

  /***** Summary computation: average IAQI values across visible area *****/
  async function computeAndShowSummaryForStations(centerLat, centerLng, stations){
    // stations: array from /map/bounds: {uid, aqi, lat, lon, station}
    // we'll pick up to MAX_DETAIL_STATIONS closest stations to center for detail fetch
    if(!stations || stations.length === 0){
      resetSummary();
      return;
    }

    // sort by distance to center
    const scored = stations.map(s => {
      const d = distanceKm(centerLat, centerLng, s.lat, s.lon);
      return {...s, dist: d};
    }).sort((a,b)=>a.dist - b.dist);

    const toFetch = scored.slice(0, MAX_DETAIL_STATIONS);
    const urls = toFetch.map(s => `https://api.waqi.info/feed/@${s.uid}/?token=${WAQI_TOKEN}`);

    // fetch in batches to be kind to API
    const rawResults = await batchFetch(urls, 6); // returns array of parsed JSON or {error}
    const details = [];
    for(const r of rawResults){
      if(!r) continue;
      if(r.status === 'ok' && r.data) details.push(r.data);
      // sometimes our batchFetch wrapper returns object with status/error depending
      else if(r && r.data) details.push(r.data);
    }

    if(details.length === 0){
      resetSummary();
      return;
    }

    // accumulate numeric pollutant values
    const sum = { aqi:0, pm25:0, pm10:0, o3:0, no2:0, so2:0, co:0, p:0 };
    const cnt = { aqi:0, pm25:0, pm10:0, o3:0, no2:0, so2:0, co:0, p:0 };
    const distSum = { total:0 };

    details.forEach(d => {
      const aqi = (d.aqi !== undefined && !isNaN(Number(d.aqi))) ? Number(d.aqi) : null;
      if(aqi !== null){ sum.aqi += aqi; cnt.aqi++; }
      if(d.iaqi){
        if(d.iaqi.pm25 && !isNaN(Number(d.iaqi.pm25.v))){ sum.pm25 += Number(d.iaqi.pm25.v); cnt.pm25++; }
        if(d.iaqi.pm10 && !isNaN(Number(d.iaqi.pm10.v))){ sum.pm10 += Number(d.iaqi.pm10.v); cnt.pm10++; }
        if(d.iaqi.o3 && !isNaN(Number(d.iaqi.o3.v))){ sum.o3 += Number(d.iaqi.o3.v); cnt.o3++; }
        if(d.iaqi.no2 && !isNaN(Number(d.iaqi.no2.v))){ sum.no2 += Number(d.iaqi.no2.v); cnt.no2++; }
        if(d.iaqi.so2 && !isNaN(Number(d.iaqi.so2.v))){ sum.so2 += Number(d.iaqi.so2.v); cnt.so2++; }
        if(d.iaqi.co && !isNaN(Number(d.iaqi.co.v))){ sum.co += Number(d.iaqi.co.v); cnt.co++; }
        if(d.iaqi.p && !isNaN(Number(d.iaqi.p.v))){ sum.p += Number(d.iaqi.p.v); cnt.p++; }
      }
      // distance: if station includes coordinates
      if(d.city && d.city.geo && d.city.geo.length === 2){
        const lat = Number(d.city.geo[0]), lon = Number(d.city.geo[1]);
        const dist = distanceKm(centerLat, centerLng, lat, lon);
        distSum.total += dist;
      }
    });

    const avg = {
      aqi: cnt.aqi? sum.aqi / cnt.aqi : null,
      pm25: cnt.pm25? sum.pm25 / cnt.pm25 : null,
      pm10: cnt.pm10? sum.pm10 / cnt.pm10 : null,
      o3: cnt.o3? sum.o3 / cnt.o3 : null,
      no2: cnt.no2? sum.no2 / cnt.no2 : null,
      so2: cnt.so2? sum.so2 / cnt.so2 : null,
      co: cnt.co? sum.co / cnt.co : null,
      p: cnt.p? sum.p / cnt.p : null,
      avgDist: (details.length>0 && distSum.total>0) ? (distSum.total / details.length) : null,
      count: details.length
    };

    // show on UI
    updateSummaryUI(avg);
  }

  function updateSummaryUI(avg){
    const cat = aqiCategory(avg.aqi);
    const box = document.getElementById('aqiBox');
    box.style.background = cat.color;
    box.style.color = (getContrastYIQ(cat.color) === 'dark') ? '#000' : '#fff';
    document.getElementById('avgAQI').innerText = (avg.aqi === null) ? '—' : Math.round(avg.aqi);
    document.getElementById('avgCategory').innerText = cat.cat;
    document.getElementById('areaLabel').innerText = `Area: Visible Map`;
    document.getElementById('areaInfo').innerText = `Stations averaged: ${avg.count} (closest ${Math.min(MAX_DETAIL_STATIONS, avg.count)})`;
    document.getElementById('avg_pm25').innerText = toFixedOrDash(avg.pm25,1);
    document.getElementById('avg_pm10').innerText = toFixedOrDash(avg.pm10,1);
    document.getElementById('avg_o3').innerText = toFixedOrDash(avg.o3,1);
    document.getElementById('avg_no2').innerText = toFixedOrDash(avg.no2,1);
    document.getElementById('avg_so2').innerText = toFixedOrDash(avg.so2,1);
    document.getElementById('avg_co').innerText = toFixedOrDash(avg.co,1);
    document.getElementById('avg_p').innerText = toFixedOrDash(avg.p,1);
    document.getElementById('avg_dist').innerText = toFixedOrDash(avg.avgDist,1);
  }

  function resetSummary(){
    document.getElementById('avgAQI').innerText = '—';
    document.getElementById('avgCategory').innerText = '—';
    document.getElementById('areaLabel').innerText = 'Area: —';
    document.getElementById('areaInfo').innerText = `Stations averaged: 0`;
    ['pm25','pm10','o3','no2','so2','co','p','dist'].forEach(k=>{
      const el = document.getElementById('avg_'+k);
      if(el) el.innerText = '—';
    });
  }

  // helper contrast
  function getContrastYIQ(hexcolor){
    if(!hexcolor) return 'light';
    hexcolor = hexcolor.replace('#','').trim(); if(hexcolor.length===3) hexcolor = hexcolor.split('').map(c=>c+c).join('');
    const r = parseInt(hexcolor.substr(0,2),16), g = parseInt(hexcolor.substr(2,2),16), b = parseInt(hexcolor.substr(4,2),16);
    const yiq = ((r*299)+(g*587)+(b*114))/1000; return (yiq >= 128) ? 'dark' : 'light';
  }

  /***** Orchestration: refresh stations + compute summary *****/
  async function refreshStationsAndSummary(boundsStr){
    // fetch stations by bounds
    const stations = await fetchStations(boundsStr);
    lastStations = stations;
    renderStationMarkers(stations);

    // pick center of bounds as reference
    const b = map.getBounds();
    const center = b.getCenter();
    // compute average details for nearest N stations (requests)
    await computeAndShowSummaryForStations(center.lat, center.lng, stations);
  }

  /***** City selection & progressive station fetch *****/
  async function selectCity(obj){
    // center
    map.setView([obj.lat, obj.lng], 11);
    document.getElementById('citySelect').value = JSON.stringify(obj);
    // build small bounding box and refresh
    const deltas = [0.5, 1.0, 2.0];
    for(const d of deltas){
      const bounds = `${obj.lat + d},${obj.lng - d},${obj.lat - d},${obj.lng + d}`;
      const stations = await fetchStations(bounds);
      if(stations && stations.length>0){
        renderStationMarkers(stations);
        await computeAndShowSummaryForStations(obj.lat, obj.lng, stations);
        // fit to stations
        const pts = stations.map(s=>[s.lat, s.lon]);
        try{ map.fitBounds(pts, { maxZoom:12, padding:[40,40] }); }catch(e){}
        return;
      }
    }
    alert('No AQI stations found near the selected city.');
  }

  /***** Auto-detect location on load (choose nearest curated or fallback) *****/
  async function autoDetect(){
    if(!navigator.geolocation){
      await selectCity(FALLBACK_CITY);
      return;
    }
    try{
      const pos = await new Promise((res,rej)=> navigator.geolocation.getCurrentPosition(res, rej, { timeout:10000, maximumAge:60000 }));
      const lat = pos.coords.latitude, lng = pos.coords.longitude;
      // find nearest curated city
      let best = null, bestD = Infinity;
      curatedCities.forEach(c=>{
        const d = distanceKm(lat,lng,c.lat,c.lng);
        if(d < bestD){ bestD = d; best = c; }
      });
      if(best && bestD < 300){
        await selectCity(best);
      } else {
        // fallback to jakarta
        await selectCity(FALLBACK_CITY);
      }
    }catch(e){
      await selectCity(FALLBACK_CITY);
    }
  }

  /***** Boot *****/
  (function bootstrap(){
    // init UI
    populateDropdown();
    // init map
    initMap();
    // auto detect location
    autoDetect();
  })();

  </script>
</body>
</html>
