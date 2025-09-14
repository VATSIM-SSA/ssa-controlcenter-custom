# ssa-controlcenter-custom/Dockerfile
FROM ghcr.io/vatsim-scandinavia/control-center:v6

# ---- Optional theming via upstream helper (rebuilds assets)
# ENV VITE_THEME_PRIMARY="#0b5fff"
# RUN chmod +x container/theme/build.sh && container/theme/build.sh

# ---- Bring in SSA customizations
# Put your Laravel migrations here and any public assets overrides
# (Use a unique folder so we can point artisan at it)
COPY custom/migrations/ /opt/custom/migrations/
COPY custom/public/ /app/public/

# Run core + custom migrations at container start, then launch Apache
# (Upstream demo uses this pattern)
CMD bash -lc "php artisan migrate --force && \
              php artisan migrate --path=/opt/custom/migrations --force && \
              exec apache2-foreground"
