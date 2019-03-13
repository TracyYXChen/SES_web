# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 29.94, -24.27, 10.89, -39.57, 56.77, 29.75, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -41.79, -18.53, 11.74, 33.82, 42.79, 26.95, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -2.74, 1.92, 67.78, -2.06, 24.35, -26.06, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
