# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 3.33, -7.13, 16.10, -20.82, -17.20, -16.01, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -6.49, 7.15, -7.20, -10.50, -30.94, 7.77, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 10.39, -18.81, -11.75, -24.86, -6.23, 10.82, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_8')
