# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 63.82, -93.32, -4.67, 39.86, -69.44, -0.23, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 62.62, -66.99, -19.22, 41.16, -94.63, 13.57, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 39.81, -90.15, -17.72, 63.63, -72.01, 13.16, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
