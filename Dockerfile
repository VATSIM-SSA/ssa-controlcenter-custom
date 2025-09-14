# Pin a known-good upstream release (update as you wish)
FROM ghcr.io/vatsim-scandinavia/controlcenter:v6.3.4

# 1) Copy any upstream file overrides (same paths as /app)
#    e.g., migration fixes, blade/view overrides, config stubs, etc.
COPY overrides/ /app/

# 2) Copy division-only migrations (run AFTER core)
COPY custom/migrations/ /opt/custom/migrations/
