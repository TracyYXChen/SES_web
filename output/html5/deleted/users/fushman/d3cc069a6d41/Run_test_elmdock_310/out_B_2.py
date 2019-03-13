# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -27.99, 11.76, 20.35, -52.11, 1.52, -11.60, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -37.86, 25.97, -2.98, -41.75, -12.12, 12.16, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -20.93, -0.01, -7.43, -56.18, 12.57, 15.14, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_2')
