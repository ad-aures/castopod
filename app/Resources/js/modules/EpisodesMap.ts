import {
  control,
  featureGroup,
  icon,
  map,
  Marker,
  marker,
  tileLayer,
} from "leaflet";
import { MarkerClusterGroup } from "leaflet.markercluster";
import "leaflet.markercluster/dist/MarkerCluster.css";
import "leaflet.markercluster/dist/MarkerCluster.Default.css";
import "leaflet/dist/leaflet.css";
import markerIconRetina from "../../images/marker/marker-icon-2x.png";
import markerIcon from "../../images/marker/marker-icon.png";
import markerShadow from "../../images/marker/marker-shadow.png";

Marker.prototype.options.icon = icon({
  iconRetinaUrl: markerIconRetina,
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  tooltipAnchor: [16, -28],
  shadowSize: [41, 41],
});

const drawEpisodesMap = async (mapDivId: string, dataUrl: string) => {
  const episodesMap = map(mapDivId).setView([48.858, 2.294], 13);

  tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>',
  }).addTo(episodesMap);
  control.scale({ imperial: true, metric: true }).addTo(episodesMap);

  const data = await fetch(dataUrl).then((response) => response.json());

  if (data.length > 0) {
    const markers = [];
    const cluster = new MarkerClusterGroup({ showCoverageOnHover: false });
    for (let i = 0; i < data.length; i++) {
      const currentMarker = marker([
        data[i].latitude,
        data[i].longitude,
      ]).bindPopup(
        '<div class="flex min-w-max w-full gap-x-2"><img src="' +
          data[i].cover_path +
          '" alt="' +
          data[i].episode_title +
          '" class="rounded w-16 h-16" /><div class="flex flex-col flex-1"><h2 class="leading-tight text-sm w-56 line-clamp-2 font-bold"><a href="' +
          data[i].episode_link +
          '" class="hover:underline font-semibold !text-accent-base">' +
          data[i].episode_title +
          '</a></h2><a href="' +
          data[i].podcast_link +
          '" class="hover:underline text-xs !text-black !mt-0 !mb-2">' +
          data[i].podcast_title +
          "</a>" +
          '<a href="' +
          data[i].location_url +
          '" class="inline-flex items-center hover:underline text-xs !text-gray-500" target="_blank" rel="noreferrer noopener"><svg class="mr-1" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M18.364 17.364L12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0zM12 13a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></g></svg>' +
          data[i].location_name +
          "</a></div></div>"
      );
      markers.push(currentMarker);
      cluster.addLayer(currentMarker);
    }
    episodesMap.addLayer(cluster);
    const group = featureGroup(markers);
    episodesMap.fitBounds(group.getBounds());
  }
};

const DrawEpisodesMaps = (): void => {
  const mapDivs: NodeListOf<HTMLDivElement> = document.querySelectorAll(
    "div[data-episodes-map-data-url]"
  );
  for (let i = 0; i < mapDivs.length; i++) {
    const mapDiv: HTMLDivElement = mapDivs[i];

    if (mapDiv.dataset.episodesMapDataUrl) {
      drawEpisodesMap(mapDiv.id, mapDiv.dataset.episodesMapDataUrl);
    }
  }
};

export default DrawEpisodesMaps;
