# IoT-Enabled Web Application — CIM (BUET IPE-20)

A lightweight web portal for the Computer Integrated Manufacturing (CIM) course at BUET (Department of IPE).  
It showcases student project groups, posters, and (optionally) surfaces sensor data via simple PHP endpoints.

> **Tech:** HTML/CSS/JS with PHP for data fetching.

---

## Table of Contents
- [Screenshots](#screenshots)
- [Features](#features)
- [Project Structure](#project-structure)
- [Deployment](#deployment)
- [Credits](#credits)

---

## Screenshots

> <!--UI screenshots/gifs here for a quick visual overview.-->
><img width="1365" height="641" alt="image" src="https://github.com/user-attachments/assets/21cb13aa-001c-45d2-aa31-3d6402283a97" />

> <!--Example placeholders (UI screenshots):-->
>
> 
> 

---

## Features

- **Group project gallery**: Pages for A1–A12, B1–B12 under `groups/` with posters and related content.
- **Posters & circuits**: Rich assets in `groups/poster/` and `groups/circuits/`.
- **Sensor data view (optional)**: Simple PHP scripts for fetching group/sensor data from your backend.
- **Course information**: Landing pages (`index.html`, `contact_info.html`) for course context and contacts.

---

## Project Structure
<pre> 
.
├─ 400.shtml
├─ 404.shtml
├─ index.html
├─ index.html_bk
├─ index.html_bl2
├─ contact_info.html
├─ get_data.php
├─ error_log # consider ignoring in git
├─ php_errors.log # consider ignoring in git
├─ Sensor_data/
│ ├─ data_info.html
│ ├─ fetch_group_data.php
│ └─ fetch_sensors.php
├─ groups/
│ ├─ group_info.html
│ ├─ style.css
│ ├─ circuits/
│ │ └─ b4.png
│ ├─ poster/
│ │ ├─ A2.jpg ... A10.jpg
│ │ ├─ B1.png ... B12.jpg
│ └─ all_groups/
│ ├─ a_1.html ... a_12.html
│ ├─ b_1.html ... b_12.html
│ ├─ script.js
│ ├─ show_data.php
│ ├─ style.css
│ └─ get_max_sensor_data.php
└─ images/
├─ fuad.png
└─ abdullah_meow.jpg
</pre>

## Deployment
Static preview
```bash
git clone https://github.com/md-muqtadir-fuad/IoT-Enabled-Web-Application-CIM.git
cd IoT-Enabled-Web-Application-CIM
```
## Credits

- Course: **BUET IPE-20 — CIM**
- Authors/Contributors: See repo contributors

## Contributors
[![Contributors](https://contrib.rocks/image?repo=md-muqtadir-fuad/IoT-Enabled-Web-Application-CIM)](https://github.com/md-muqtadir-fuad/IoT-Enabled-Web-Application-CIM/graphs/contributors)


