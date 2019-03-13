# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 88.72, -99.68, -18.65, 55.07, -63.26, 13.13, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 42.55, -102.59, -8.60, 102.39, -58.35, 4.05, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 77.36, -95.36, 19.97, 64.16, -62.86, -31.25, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
