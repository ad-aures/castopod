import type { APIRoute } from "astro";
import manifestSchema from "../../../modules/Plugins/Manifest/manifest.schema.json";

export const GET: APIRoute = async () => {
  return new Response(JSON.stringify(manifestSchema), {
    headers: { "Content-Type": "application/json" },
  });
};
